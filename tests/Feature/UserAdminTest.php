<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAdminTest extends TestCase
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

    public function test_admin_moze_pristupiti_admin_dashboardu(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_obicni_korisnik_ne_moze_pristupiti_admin_dashboardu(): void
    {
        $user = $this->user();

        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_admin_moze_vidjeti_listu_korisnika(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)
            ->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee($admin->email);
    }
}
