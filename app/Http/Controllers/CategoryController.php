<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $categories = Category::orderBy('id')
            ->paginate(5);

        return view(
            'categories.index',
            compact('categories')
        );
    }

    public function indexDb(){
        $categories = DB::table('categories')->get();
 
        return view('categories.indexDb', ['categories' => $categories]);
    }

    public function summary()
    {
        $categories = Category::withCount('products')
            ->withSum('products', 'cijena')
            ->withMin('products', 'cijena')
            ->withMax('products', 'cijena')
            ->withAvg('products', 'cijena')
            ->orderBy('naziv')
            ->paginate(5);

        return view(
            'categories.summary',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin-access');

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'naziv' => [
                'required',
                'string',
                'max:255',
            ],
            'opis' => [
                'nullable',
                'string',
            ],
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategorija je uspješno dodana.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view(
            'categories.show',
            compact('category')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         Gate::authorize('admin-access');

        return view(
            'categories.edit',
            compact('category')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        Gate::authorize('admin-access');

        $validated = $request->validate([
            'naziv' => [
                'required',
                'string',
                'max:255',
            ],
            'opis' => [
                'nullable',
                'string',
            ],
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategorija je uspješno ažurirana.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('admin-access');

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategorija je uspješno obrisana.'
            );
    }
}
