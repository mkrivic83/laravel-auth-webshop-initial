<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'isAdmin' => true,
            'datum_rod' => '1980-01-01',
            'placa' => 3000,
        ]);
    }

    private function user(): User
    {
        return User::factory()->create([
            'isAdmin' => false,
            'datum_rod' => '1990-01-01',
            'placa' => 1500,
        ]);
    }

    private function category(): Category
    {
        return Category::create([
            'naziv' => 'Laptopi',
            'opis' => 'Prijenosna računala',
        ]);
    }

    private function product(): Product
    {
        $category = $this->category();

        return Product::create([
            'category_id' => $category->id,
            'naziv' => 'Lenovo ThinkPad',
            'opis' => 'Poslovni laptop',
            'cijena' => 799.99,
            'kolicina' => 10,
            'izvor' => 'custom',
        ]);
    }

    public function test_admin_moze_vidjeti_listu_proizvoda(): void
    {
        $admin = $this->admin();
        $this->product();

        $response = $this->actingAs($admin)
            ->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee('Lenovo ThinkPad');
    }

    public function test_obicni_korisnik_moze_vidjeti_listu_proizvoda(): void
    {
        $user = $this->user();
        $this->product();

        $response = $this->actingAs($user)
            ->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee('Lenovo ThinkPad');
    }

    public function test_admin_moze_vidjeti_formu_za_novi_proizvod(): void
    {
        $admin = $this->admin();
        $this->category();

        $response = $this->actingAs($admin)
            ->get(route('products.create'));

        $response->assertStatus(200);
        $response->assertSee('Novi proizvod');
    }

    public function test_obicni_korisnik_ne_moze_vidjeti_formu_za_novi_proizvod(): void
    {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->get(route('products.create'));

        $response->assertStatus(403);
    }

    public function test_admin_moze_dodati_proizvod(): void
    {
        $admin = $this->admin();
        $category = $this->category();

        $response = $this->actingAs($admin)
            ->post(route('products.store'), [
                'category_id' => $category->id,
                'naziv' => 'HP ProBook',
                'opis' => 'Laptop za ured',
                'cijena' => 699.99,
                'kolicina' => 5,
            ]);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'naziv' => 'HP ProBook',
            'izvor' => 'custom',
        ]);
    }

    public function test_obicni_korisnik_ne_moze_dodati_proizvod(): void
    {
        $user = $this->user();
        $category = $this->category();

        $response = $this->actingAs($user)
            ->post(route('products.store'), [
                'category_id' => $category->id,
                'naziv' => 'Zabranjeni proizvod',
                'opis' => 'Opis',
                'cijena' => 100,
                'kolicina' => 1,
            ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('products', [
            'naziv' => 'Zabranjeni proizvod',
        ]);
    }

    public function test_admin_moze_azurirati_proizvod(): void
    {
        $admin = $this->admin();
        $product = $this->product();

        $response = $this->actingAs($admin)
            ->put(route('products.update', $product), [
                'category_id' => $product->category_id,
                'naziv' => 'Lenovo ThinkPad Updated',
                'opis' => 'Ažurirani opis',
                'cijena' => 899.99,
                'kolicina' => 20,
            ]);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'naziv' => 'Lenovo ThinkPad Updated',
        ]);
    }

    public function test_admin_moze_obrisati_proizvod(): void
    {
        $admin = $this->admin();
        $product = $this->product();

        $response = $this->actingAs($admin)
            ->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_detalji_proizvoda_prikazuju_kategoriju(): void
    {
        $user = $this->user();
        $product = $this->product();

        $response = $this->actingAs($user)
            ->get(route('products.show', $product));

        $response->assertStatus(200);
        $response->assertSee('Laptopi');
        $response->assertSee('Lenovo ThinkPad');
    }

    public function test_search_proizvoda_po_nazivu_radi(): void
    {
        $user = $this->user();
        $this->product();

        $response = $this->actingAs($user)
            ->get(route('products.search', [
                'search' => 'ThinkPad',
            ]));

        $response->assertStatus(200);
        $response->assertSee('Lenovo ThinkPad');
    }

    public function test_vraca_ispravan_broj_proizvoda_po_kategoriji(): void
{
    // -------------------------------------------------
    // Arrange (Priprema podataka)
    // -------------------------------------------------

    $admin = $this->admin();

    $laptopi = Category::create([
    'naziv' => 'Laptopi',
    'opis' => 'Laptop računala',
    ]);

    $televizori = Category::create([
        'naziv' => 'Televizori',
        'opis' => 'Smart TV',
    ]);

    for ($i = 1; $i <= 3; $i++) {

    Product::create([

        'naziv' => 'Laptop ' . $i,

        'opis' => 'Opis',

        'cijena' => 1000,

        'kolicina' => 5,

        'category_id' => $laptopi->id,

        'izvor' => 'custom',

    ]);

}

for ($i = 1; $i <= 2; $i++) {

    Product::create([

        'naziv' => 'TV ' . $i,

        'opis' => 'Opis',

        'cijena' => 1500,

        'kolicina' => 3,

        'category_id' => $televizori->id,

        'izvor' => 'custom',

    ]);

}

    // -------------------------------------------------
    // Act (Izvršavanje akcije)
    // -------------------------------------------------

    $response = $this
        ->actingAs($admin)
        ->get(route('categories.productsSummary'));

//     dd(
//     $response->status(),
//     $response->content(),
//     $response->exception
// );

    // -------------------------------------------------
    // Assert (Provjera rezultata)
    // -------------------------------------------------

    $response->assertOk();

    $response->assertViewHas('categories');

    $categories = $response->viewData('categories');

    $this->assertEquals(
        3,
        $categories->firstWhere('naziv', 'Laptopi')->products_count
    );

    $this->assertEquals(
        2,
        $categories->firstWhere('naziv', 'Televizori')->products_count
    );
}
}
