<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class WishlistController extends Controller
{
    public function viewWishList()
    {
        $userId = auth()->id();

        $user = User::with('posts')->find($userId);
        $wishPosts = $user->wishList;
        
        return view('reads.wish_list', compact('user','wishPosts'));
    }
    public function operateWishList(Request $request, $id)
    {
       
        // 済ボタンが押された際の処理
        $user = auth()->user();
        $post = Post::findOrFail($id);

        if ($post->wishList()->where('user_id', $user->id)->exists()) {
            // いいねを解除
            $post->wishList()->detach($user->id);
        } else {
            // いいねを付ける
            $post->wishList()->attach($user->id);
        }
        
        return redirect()->back();
    }
}
