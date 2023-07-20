<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\ToppageController;

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

// <--toppage-->
Route::get('/',  [ToppageController::class, 'toppage'])->name('toppage');


// <--serch_index-->
Route::get('posts/serch_index', [SerchIndexController::class, 'serch_index'])->name('serch_index');

// <--show-->
Route::get('/posts/{post}', [PostController::class ,'show']);




Route::get('posts/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');


Route::middleware('auth')->group(function () {
    // <--create-->
    Route::get('/posts/create', [CreateController::class, 'create'])->name('create');
    // <search_source_story>
    
    // <search_inspired_by_story>
    
    //< wish_list>
    Route::get('/reads/wish_list', [WishListController::class, 'wish_list'])->name('wish_list');
    // <--profire-->
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';