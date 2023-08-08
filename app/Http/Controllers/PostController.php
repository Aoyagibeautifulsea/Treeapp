<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
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
    // <--投稿制作create-->
     public function create()
    {
        $tags = Tag::all();
    return view('posts.create', compact('tags'));
    }
     public function store(PostRequest $request, Post $post, Creator $creator,Image $image, Link $link )
    {
        
     $post->user_id = Auth::id();
     $post_input = $request['post'];
    
      //  bool型でデータを格納
     $agecheck = $request->has('post.age_limit') ? true : false;
     $post_input['age_limit'] = $agecheck;
     $post_input['age_limit'] = (boolean)
     $post_input['age_limit'];
     
     $aicheck = $request->has('post.ai_generate_check') ? true : false;
     $post_input['ai_generate_check'] = $aicheck;
     $post_input['ai_generate_check'] = (boolean)
     $post_input['ai_generate_check'];
     
     $post->fill($post_input)->save();
     
     $creator->name = $request['name'];
     $creator->post_id = $post->id;
     $creator->save();
     
     $image->image_path = $request['image_path'];
     $image->post_id = $post->id;
     $image->save();
     
     $link->external_link = $request['external_link'];
     $link->external_link_explanation = $request['external_link_explanation'];
     $link->post_id = $post->id;
     $link->save();
     
     $gettag = $request->input('tags_array', []);
    // タグを関連付ける
     $post->tags()->sync($gettag);
    
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
        if ($post->favoritedBy()->where('user_id', $user->id)->exists()) {
            // いいねを解除
            $post->favoritedBy()->detach($user->id);
        } else {
            // いいねを付ける
            $post->favoritedBy()->attach($user->id);
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
// 　

//   <--子作品inspiredbystory-->
      public function showinspiredbystory(Post $post)
{
    return view('posts.search_inspired_by_story')->with(['posts' => $post->getinspiredbystory()]);
}
}
