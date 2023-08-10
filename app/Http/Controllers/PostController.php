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
use App\Models\Source_story;
use App\Models\Inspired_by_story;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
//   <--詳細表示show-->
     public function show(Post $post)
    {
        $tags = Tag::all();
        
        foreach ($post->tags as $tag) {
            $tag->relatedPosts = $tag->posts->where('id', '<>', $post->id)->shuffle();
        }
        
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
      public function edit(Post $post, Creator $creator,Image $image, Link $link)
    {
        $tags = Tag::all();
        return view('posts.edit', compact('post','tags'));
    }

    public function update(Request $request, Post $post, Creator $creator,Image $image, Link $link)
    {
        // 既存の関連データを削除
        $post->creators()->delete();
        $post->images()->delete();
        $post->links()->delete();
        
        $post_input = $request['post'];

        // bool型でデータを格納
        $agecheck = $request->has('post.age_limit') ? true : false;
        $post_input['age_limit'] = $agecheck;
        $post_input['age_limit'] = (boolean) $post_input['age_limit'];

        $aicheck = $request->has('post.ai_generate_check') ? true : false;
        $post_input['ai_generate_check'] = $aicheck;
        $post_input['ai_generate_check'] = (boolean) $post_input['ai_generate_check'];

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

    public function confirm(Post $post)
    {
        return view('posts.confirm', compact('post'));
    }

    public function destroy(Post $post, Creator $creator,Image $image, Link $link)
    {
        $post->delete();
        $post->creators()->delete();
        $post->images()->delete();
        $post->links()->delete();

        return redirect()->route('backmypage');
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
    public function serchsourcestory(Request $request)
{
    $keyword = $request->input('keyword');
        $title_Keyword =$request->input('title_keyword');
        $author_Keyword = $request->input('author_keyword');
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $selectedTags = $request->input('tags');
        $selectedTags = [];

        $query = Post::query();

       // 作品名での検索
        if ($request->input('search_type') === 'title') {
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            }
        }

        // 作者名での検索
        if ($request->input('search_type') === 'author') {
            if (!empty($author_Keyword)) {
                $query->whereHas('creator', function ($q) use ($author_Keyword) {
                    $q->where('name', 'LIKE', "%{$author_Keyword}%");
                });
            }
        }

        // 年代での検索
        if ($request->input('search_type') === 'year') {
            if (!empty($startYear) && !empty($endYear)) {
                $query->whereBetween('released_date', [$startYear, $endYear]);
            }
        }
        // タグでの検索
         if ($request->input('search_type') === 'tag' && !empty($selectedTags)) {
        // $selectedTagsが空でない場合にのみ検索条件を追加
        $query->whereHas('tags', function ($q) use ($selectedTags) {
            $q->whereIn('id', $selectedTags);
        });
        }
        $tags = Tag::all();

        $posts = $query->get();
    return view('posts.search_source_story', compact('posts', 'keyword', 'title_Keyword', 'author_Keyword', 'startYear', 'endYear','tags', 'selectedTags'));
}
    public function addsourcestory(Post $post)
{
    $sourceStory = new Source_story();
        $sourceStory->senior_post_id = $post->id; 
        $sourceStory->post_id = $post->id; 

        $sourceStory->save();

    return redirect()->back();
}
// 　

//   <--子作品inspiredbystory-->
      public function searchinspiredbystory(Post $post)
{
    $keyword = $request->input('keyword');
        $title_Keyword =$request->input('title_keyword');
        $author_Keyword = $request->input('author_keyword');
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $selectedTags = $request->input('tags');
        $selectedTags = [];

        $query = Post::query();

       // 作品名での検索
        if ($request->input('search_type') === 'title') {
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            }
        }

        // 作者名での検索
        if ($request->input('search_type') === 'author') {
            if (!empty($author_Keyword)) {
                $query->whereHas('creator', function ($q) use ($author_Keyword) {
                    $q->where('name', 'LIKE', "%{$author_Keyword}%");
                });
            }
        }

        // 年代での検索
        if ($request->input('search_type') === 'year') {
            if (!empty($startYear) && !empty($endYear)) {
                $query->whereBetween('released_date', [$startYear, $endYear]);
            }
        }
        // タグでの検索
         if ($request->input('search_type') === 'tag' && !empty($selectedTags)) {
        // $selectedTagsが空でない場合にのみ検索条件を追加
        $query->whereHas('tags', function ($q) use ($selectedTags) {
            $q->whereIn('id', $selectedTags);
        });
        }
        $tags = Tag::all();

        $posts = $query->get();
    return view('posts.search_inspired_by_story', compact('posts', 'keyword', 'title_Keyword', 'author_Keyword', 'startYear', 'endYear','tags', 'selectedTags'));
}
     public function addinspiredbystory(Post $post)
{
    $sourceStory = new Source_story();
        $sourceStory->senior_post_id = $post->id; // 投稿のIDを関連付ける
        $sourceStory->post_id = $post->id; // ソースストーリーに対する投稿のIDを関連付ける

        $sourceStory->save();

    return redirect()->back();
}


}
