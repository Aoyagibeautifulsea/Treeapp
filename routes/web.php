<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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


Route::get('/',  [PostController::class, 'toppage'])->name('toppage');


Route::get('/', [PostController::class, 'toppage'])->name('toppage');

Route::get('posts/serch_index', [PostController::class, 'serch_index'])->name('serch_index');
Route::get('/posts/{post}', [PostController::class ,'show']);


Route::get('posts/create', function () {
    return view('create');
})->middleware(['auth', 'verified'])->name('create');

Route::get('posts/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';