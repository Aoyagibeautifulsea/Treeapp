<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class MypageController extends Controller
{
     public function showmypage()
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->id();

        // ユーザーの投稿を取得
        $user = User::with('posts')->find($userId);
        // ログインユーザーのいいねした投稿を取得
        $likedPosts = $user->likedPosts;

        return view('mypages.mypage', compact('user', 'likedPosts'));
    }
}
