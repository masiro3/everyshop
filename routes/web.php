<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\HomeController::class, 'create'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'search']);
    Route::post('/search', [App\Http\Controllers\ItemController::class, 'search']);
});




    Route::prefix('books')->group(function () {
    Route::get('/', [App\Http\Controllers\BookController::class, 'index']);
    
    Route::get('/add', [App\Http\Controllers\BookController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\BookController::class, 'add']);

    Route::post('/stock/minus/{id}', [App\Http\Controllers\BookController::class, 'minus']);
    Route::post('/stock/plus/{id}', [App\Http\Controllers\BookController::class, 'plus']);
    
    Route::get('/search', [App\Http\Controllers\BookController::class, 'search']);
    Route::post('/search', [App\Http\Controllers\BookController::class, 'search']);
    
    // /books/edit/8
    Route::get('/edit/{id}', [App\Http\Controllers\BookController::class, 'edit']);
    Route::post('/bookEdit', [App\Http\Controllers\BookController::class, 'bookEdit']);

    Route::get('/bookDelete/{id}', [App\Http\Controllers\BookController::class, 'bookDelete']);
});
