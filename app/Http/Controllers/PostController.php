<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Creator;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
//   <--詳細表示show-->
     public function show(Post $post)
    {
        $tags = Tag::all();
    return view('posts.show', compact('post', 'tags'));
    }

    public function updateTags(Request $request, Post $post)
    {
        $post->tags()->sync($request->input('tags')); 

    return redirect()->route('post.show', $post->id)->with('success', 'タグが更新されました。');
    }
    // <--投稿制作create-->
     public function create()
    {
    return view('posts.create');
    }
     public function store(PostRequest $request, Post $post, Tag $tag )
    {
        dd($request);
     $post->user_id = Auth::id();
     $post_input = $request['post'];
     $tag_input = $request['tag'];
     $post->fill($post_input)->save();
     $tag->fill($tag_input)->save();
    return redirect('/posts/' . $post->id);
    }
    
    // <--mypage関連-->
      public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('mypage');
    }

    public function confirm(Post $post)
    {
        return view('posts.confirm', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('mypage');
    }
    
    // <--いいね関連-->
    public function like(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        // 既にいいねしているか確認
        if ($post->users()->where('user_id', $user->id)->exists()) {
            // いいねを解除
            $post->users()->detach($user->id);
        } else {
            // いいねを付ける
            $post->users()->attach($user->id);
        }

        return redirect()->back();
    }
    
//     public function show(Post $post)
// {
//     return view('posts.show')->with(['post' => $post]);
// }

//     <--親作品sourcestory-->
    public function showsourcestory(Post $post)
{
    return view('posts.search_source_story')->with(['posts' => $post->getsourcestory()]);
}
// 　　$posts = $post->getsourcestory();
// return view('posts.search_source_story', compact('posts'));

//   <--子作品inspiredbystory-->
      public function showinspiredbystory(Post $post)
{
    return view('posts.search_inspired_by_story')->with(['posts' => $post->getinspiredbystory()]);
}
}
