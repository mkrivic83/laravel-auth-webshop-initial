<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class DummyProductController extends Controller
{
      public function index(Request $request)
    {
        $perPage = 10;
        $page = (int) $request->input('page', 1);
        $skip = ($page - 1) * $perPage;
        $search = $request->input('search');

        $endpoint = $search
            ? 'https://dummyjson.com/products/search'
            : 'https://dummyjson.com/products';

        $response = Http::get($endpoint, [
            'q' => $search,
            'limit' => $perPage,
            'skip' => $skip,
            'select' => 'title,price,category,stock,description',
        ]);

        if (! $response->successful()) {
            abort(500, 'Greška kod dohvata proizvoda sa servisa.');
        }

        $data = $response->json();

        $products = collect($data['products'] ?? []);

        $savedProducts = Product::with('category')
            ->where('izvor', 'servis')
            ->get()
            ->mapWithKeys(function ($product) {
                $key = Str::lower($product->naziv) . '|' . Str::lower($product->category?->naziv);

                return [
                    $key => true,
                ];
            });

        $products = $products->map(function ($product) use ($savedProducts) {
            $key = Str::lower($product['title']) . '|' . Str::lower($product['category']);

            $product['saved'] = $savedProducts->has($key);

            return $product;
        });

        $paginator = new LengthAwarePaginator(
            $products,
            $data['total'] ?? 0,
            $perPage,
            $page,
            [
                'path' => route('dummy-products.index'),
                'query' => $request->query(),
            ]
        );

        return view('dummy-products.index', [
            'products' => $paginator,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
            'category' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $category = Category::firstOrCreate(
            [
                'naziv' => $validated['category'],
            ],
            [
                'opis' => 'Kategorija dohvaćena sa DummyJSON servisa.',
            ]
        );

        $product = Product::firstOrCreate(
            [
                'naziv' => $validated['title'],
                'category_id' => $category->id,
                'izvor' => 'servis',
            ],
            [
                'opis' => $validated['description'],
                'cijena' => $validated['price'],
                'kolicina' => $validated['stock'],
            ]
        );

        if ($product->wasRecentlyCreated) {
            return redirect()
                ->route('dummy-products.index', $request->only('search', 'page'))
                ->with('success', 'Proizvod je uspješno spremljen iz servisa.');
        }

        return redirect()
            ->route('dummy-products.index', $request->only('search', 'page'))
            ->with('success', 'Proizvod je već ranije spremljen.');
    }


}
