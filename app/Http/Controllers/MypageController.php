<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MypageController extends Controller
{
    public function updatepassword()
    {
        return view('profile.partials.update-password-form');
    }
    public function deleteuser()
    {
        return view('profile.partials.delete-user-form');
    }
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
     public function showmypage()
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->id();

        // ユーザーの投稿を取得
        $user = User::with('posts')->find($userId);
        // ログインユーザーのいいねした投稿を取得
        $likedPosts = $user->favoritePosts;
        
        $tags = Tag::all();

        return view('mypages.mypage', compact('user', 'tags', 'likedPosts'));
    }
    
     public function favoritetagstore(Request $request)
    {
    $user = Auth::user(); // ログイン中のユーザーを取得する方法に変更
    $tagsArray = $request->input('tags_array', []);

    // 既存のお気に入りタグを削除
    $user->favoritetag()->detach();

    // 新しいお気に入りタグを登録
    foreach ($tagsArray as $tagId) {
        $user->favoritetag()->attach($tagId);
    }

    return redirect()->back()->with('success', 'お気に入りタグが保存されました。');
    }
    
}
