<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class WishlistController extends Controller
{
 public function addToWishList(Request $request, $postId)
    {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        $user->wishList()->attach($post);

        return redirect()->back();
    }

    public function viewWishList()
    {
        $user = auth()->user();
        $wishList = $user->wishList;

        return view('reads.wish_list', compact('wishList'));
    }
    public function completeWishList(Request $request)
    {
        // 済ボタンが押された際の処理
        $user = auth()->user();
        $postId = $request->input('post_id');

        // Wish Listから投稿を削除
        $user->wishList()->detach($postId);

        return redirect()->route('wish_list.view');
    }
}
