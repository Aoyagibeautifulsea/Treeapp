<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ToppageController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\WishListController;

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

Route::middleware('auth')->group(function () {
    // <--create-->
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::post('/create_post', [PostController::class, 'store'])->name('create_post');
//   <--いいね-->
    Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
    // <search_source_story>
    Route::get('/posts/search_source_story', [PostController::class, 'showsourcestory'])->name('showsourcestory');
    // <search_inspired_by_story>
    Route::get('/posts/search_inspired_by_story', [PostController::class, 'showinspiredbystory'])->name('showinspiredbystory');
    //< wish_list>
    Route::post('/posts/{id}/wish_list', [WishListController::class, 'operateWishList'])->name('Wish_list');
    Route::get('/reads/wish_list', [WishListController::class, 'viewWishList'])->name('wish_list.view');
    // <--mypage-->
    Route::get('mypages/mypage',[MypageController::class, 'showmypage'])->name('showmypage');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}/confirm', [PostController::class, 'confirm'])->name('posts.confirm');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    // <--profire-->
    Route::get('/update-password-form', [MypageController::class, 'updatepassword'])->name('update-password-form');
    Route::get('/delete-user-form', [MypageController::class, 'deleteuser'])->name('delete-user-form');
    Route::get('/profile', [MypageController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [MypageController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [MypageController::class, 'destroy'])->name('profile.destroy');
});
   // <--show-->
Route::get('/posts/{post}', [PostController::class ,'show']);

require __DIR__.'/auth.php';