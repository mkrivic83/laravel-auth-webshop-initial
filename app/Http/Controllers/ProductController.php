<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('id')
            ->paginate(5);

        return view('products.index', compact('products'));
    }

    public function dbIndex()
    {
        $products = DB::table('products')
            ->join(
                'categories',
                'products.category_id',
                '=',
                'categories.id'
            )
            ->select(
                'products.id',
                'products.naziv',
                'categories.naziv as kategorija',
                'products.cijena',
                'products.kolicina',
                'products.izvor'
            )
            ->orderBy('products.id')
            ->get();

        return view(
            'products.indexProd',
            compact('products')
        );
    }

    public function create()
    {
        Gate::authorize('admin-access');

        $categories = Category::orderBy('naziv')
            ->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'naziv' => [
                'required',
                'string',
                'max:255',
            ],
            'opis' => [
                'nullable',
                'string',
            ],
            'cijena' => [
                'required',
                'numeric',
                'min:0',
            ],
            'kolicina' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $validated['izvor'] = 'custom';

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Proizvod je uspješno dodan.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        Gate::authorize('admin-access');

        $categories = Category::orderBy('naziv')
            ->get();

        return view(
            'products.edit',
            compact('product', 'categories')
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'naziv' => [
                'required',
                'string',
                'max:255',
            ],
            'opis' => [
                'nullable',
                'string',
            ],
            'cijena' => [
                'required',
                'numeric',
                'min:0',
            ],
            'kolicina' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Proizvod je uspješno ažuriran.');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('admin-access');

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Proizvod je uspješno obrisan.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where('naziv', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('naziv', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('id')
            ->paginate(5)
            ->withQueryString();

        return view(
            'products.search',
            compact('products', 'search')
        );
    }
}