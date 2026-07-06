<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DummyProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {

    Gate::authorize('admin-access');

    return view('admin.dashboard');

})->middleware('auth')->name('admin.dashboard');


Route::get('/admin/users',[UserController::class, 'index'])
        ->middleware('auth')
        ->name('admin.users.index');

// Route::get('/admin/users',function () {
//         Gate::authorize('admin-access');
//         return app(
//             UserController::class
//         )->index();
//     }
// )->middleware('auth')
//  ->name('admin.users.index');

Route::get('/admin/users-paginated', [UserController::class, 'indexPaginated'])
    ->middleware('auth')
    ->name('admin.users.indexPaginated');

Route::get('/admin/users/{user}/edit',[UserController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.users.edit');

 Route::put('/admin/users/{user}',[UserController::class, 'update'])
    ->middleware('auth')
    ->name('admin.users.update'); 
    
Route::get('/admin/users/{user}/delete',[UserController::class, 'deletePreview'])
    ->middleware('auth')
    ->name('admin.users.deletePreview');

Route::delete('/admin/users/{user}',[UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.users.destroy');

//KATEGORIJE
Route::get(
    '/categories/products-summary',
    [CategoryController::class, 'productsSummary']
)->name('categories.productsSummary');


Route::resource('categories', CategoryController::class)
    ->middleware('auth');

Route::get('categoriesDb', [CategoryController::class,'indexDb'])
    ->middleware('auth')->name('categories.db');
    
Route::get('categories-summary', [CategoryController::class,'summary'])
    ->middleware('auth')->name('categories.summary');
//PROIZVODI



Route::resource('products', ProductController::class)
    ->middleware('auth');

Route::get('/productsDb', [ProductController::class, 'dbIndex'])
    ->middleware('auth')
    ->name('products.db');

Route::get('/products-search', [ProductController::class, 'search'])
    ->middleware('auth')
    ->name('products.search');

Route::get('/dummy-products', [DummyProductController::class, 'index'])
    ->middleware('auth')
    ->name('dummy-products.index');

Route::post('/dummy-products/store', [DummyProductController::class, 'store'])
    ->middleware('auth')
    ->name('dummy-products.store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';
