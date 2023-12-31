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
    public function updatePassword()
    {
        return view('profile.partials.editpassword');
    }
    
    public function deleteUser()
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
        $validated_data = $request->validated();
    
        // Update the user's profile information
        $user = $request->user();
        $user->fill($validated_data);
    
        // Check if the adult_check checkbox was submitted and update the value accordingly
        $user->adult_check = $request->has('adult_check');
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return back()->with('status', 'profile-updated');
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
    
    public function showMypage()
    {
        $user_id = auth()->id();
        $query = Post::query();
        
        $user = User::with('posts')->find($user_id);
       
        $liked_posts = $user->favoritePosts;
        
        $tags = Tag::all();
        
        $liked_posts = auth()->user()->favoritePosts()->paginate(8);
        
        return view('mypages.mypage', compact('user', 'tags', 'liked_posts'));
    }
    
    public function favoriteTagStore(Request $request)
    {
        $user = Auth::user(); 
        $tags_array = $request->input('tags_array', []);
    
        $user->favoritetag()->detach();
    
        foreach ($tags_array as $tag_id) {
            $user->favoritetag()->attach($tag_id);
        }
    
        return redirect()->back()->with('success', 'お気に入りタグが保存されました。');
    }
    
}
