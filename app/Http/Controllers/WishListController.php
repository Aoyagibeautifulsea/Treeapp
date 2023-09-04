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
        $user_id = auth()->id();

        $user = User::with('posts')->find($user_id);
        $wish_posts = $user->wishList;
        
        return view('reads.wish_list', compact('user','wish_posts'));
    }
    
    public function operateWishList(Request $request, $id)
    {
        $user = auth()->user();
        $post = Post::findOrFail($id);

        if ($post->wishList()->where('user_id', $user->id)->exists()) {
            $post->wishList()->detach($user->id);
        } else {
            $post->wishList()->attach($user->id);
        }
        
        return redirect()->back();
    }
}
