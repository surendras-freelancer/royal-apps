<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class,'loginForm'])->name('index');

Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::post('/api/get-token',  [AuthController::class,'getToken']);
Route::get('/logout', [AuthController::class,'logout'])->name('logout');


Route::middleware(['check.auth'])->group(function () {
    Route::get('/authors', [AuthorController::class,'index'])->name('authors');
    Route::get('/authors/{authorId}', [AuthorController::class,'show'])->name('authors.show');
    Route::get('/profile', [AuthController::class,'profile'])->name('profile');
    Route::get('/add-book', [BookController::class,'addBook'])->name('addBook');
    Route::post('/add-book', [BookController::class,'addBookSubmit'])->name('addBookSubmit');
    Route::get('/delete-author/{authorId}', [AuthorController::class,'deleteAuthor'])->name('authors.deleteAuthor');

});