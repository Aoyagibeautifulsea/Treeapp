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
use Illuminate\Validation\Rule;
use Cloudinary;

class PostController extends Controller
{
    
//   <--詳細表示show-->
    public function show(Post $post)
    {
        $tags = Tag::all();
        $post_id = $post->id;
        
        $comments = $post->comments()->with('user')->get();
        
        foreach ($post->tags as $tag) {
            $tag->relatedPosts = $tag->posts->where('id', '<>', $post->id)->shuffle();
        }
        return view('posts.show', compact('post', 'tags','post_id', 'comments'));
    }
    
    public function storeComment(Request $request, Post $post, Comment $comment)
    {
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id();
        $comment->body = $request->body;
        $comment->save();
    
        return back();
    }
    
   public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back();
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
        $age_check = $request->has('post.age_limit') ? true : false;
        $post_input['age_limit'] = $age_check;
        $post_input['age_limit'] = (boolean)
        $post_input['age_limit'];
         
        $ai_check = $request->has('post.ai_generate_check') ? true : false;
        $post_input['ai_generate_check'] = $ai_check;
        $post_input['ai_generate_check'] = (boolean)
        $post_input['ai_generate_check'];
         
        $post->fill($post_input)->save();
         
        $creator_names = $request->input('name', []); // 著者名の配列を取得

        foreach ($creator_names as $index => $creator_name) {
            if (!empty($creator_name)) { // 空の著者名は保存しない
                $creator_instance = new Creator();
                $creator_instance->name = $creator_name;
                $creator_instance->post_id = $post->id;
                $creator_instance->save();
            }
        }
     
        if ($request->hasFile('image_url')) {
            $image_url = Cloudinary::upload($request->file('image_url')->getRealPath())->getSecurePath();
            $image->image_url = $image_url;
            $image->post_id = $post->id;
            $image->save();
        }
     
         $external_links = $request->input('external_link', []);
         $external_link_explanations = $request->input('external_link_explanation', []);
    
        for ($i = 0; $i < count($external_links); $i++) {
            if (!empty($external_links[$i])) { 
                $link_instance = new Link();
                $link_instance->external_link = $external_links[$i];
                $link_instance->external_link_explanation = $external_link_explanations[$i] ?? null;
                $link_instance->post_id = $post->id;
                $link_instance->save();
            }
        }
     
        $get_tag = $request->input('tags_array', []);
        // タグを関連付ける
        $post->tags()->sync($get_tag);
        
        return redirect('/posts/' . $post->id);
    }
    
    // <--mypage関連-->
    public function edit(Post $post, Creator $creator,Image $image, Link $link)
    {
        $tags = Tag::all();
        return view('posts.edit', compact('post','tags'));
    }

    public function update(PostRequest $request, Post $post, Creator $creator,Image $image, Link $link)
    {
        // 既存の関連データを削除
        $post->creators()->delete();
        $post->images()->delete();
        $post->links()->delete();
        
        $post_input = $request['post'];

        // bool型でデータを格納
        $age_check = $request->has('post.age_limit') ? true : false;
        $post_input['age_limit'] = $age_check;
        $post_input['age_limit'] = (boolean) $post_input['age_limit'];

        $ai_check = $request->has('post.ai_generate_check') ? true : false;
        $post_input['ai_generate_check'] = $ai_check;
        $post_input['ai_generate_check'] = (boolean) $post_input['ai_generate_check'];

        $post->fill($post_input)->save();

        $creator_names = $request->input('creator_name', []); // 著者名の配列を取得

        foreach ($creator_names as $index => $creator_name) {
        if (!empty($creator_name)) { // 空の著者名は保存しない
        $creator_instance = new Creator();
        $creator_instance->name = $creator_name;
        $creator_instance->post_id = $post->id;
        $creator_instance->save();
            }
        }
     
        if ($request->hasFile('image_url')) {
        $image_url = Cloudinary::upload($request->file('image_url')->getRealPath())->getSecurePath();
        $image->image_url = $image_url;
        $image->post_id = $post->id;
        $image->save();
        }
         
        $external_links = $request->input('external_link', []);
        $external_link_explanations = $request->input('external_link_explanation', []);
        
        if (!empty($external_links)) {
        for ($i = 0; $i < count($external_links); $i++) {
            if (!empty($external_links[$i])) { 
                $link_instance = new Link();
                $link_instance->external_link = $external_links[$i];
                $link_instance->external_link_explanation = $external_link_explanations[$i] ?? null;
                $link_instance->post_id = $post->id;
                $link_instance->save();
                }
            }
        }

        $get_tag = $request->input('tags_array', []);
        // タグを関連付ける
        $post->tags()->sync($get_tag);
        

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
//     <--親作品sourcestory-->
    public function searchSourceStory(Request $request)
    {
        $keyword = $request->input('keyword');
        $title_keyword =$request->input('title_keyword');
        $author_keyword = $request->input('author_keyword');
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');
        $selected_tags = $request->input('tags_array', []);
        $post_id = $request->input('post_id');
        $query = Post::query();

       // 作品名での検索
        if ($request->input('search_type') === 'title') {
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            }
        }

        // 作者名での検索
        if ($request->input('search_type') === 'author') {
            if (!empty($author_keyword)) {
                $query->whereHas('creators', function ($q) use ($author_keyword) {
                    $q->where('name', 'LIKE', "%{$author_keyword}%");
                });
            }
        }

        // 年代での検索
        if ($request->input('search_type') === 'year') {
            if (!empty($start_year) && !empty($end_year)) {
                $query->whereBetween('released_date', [$start_year, $end_year]);
            }
        }
        // タグでの検索
         if ($request->input('search_type') === 'tag' && !empty($selected_tags)) {
        // $selectedTagsが空でない場合にのみ検索条件を追加
        $query->whereHas('tags', function ($q) use ($selected_tags) {
            $q->whereIn('id', $selected_tags);
        });
        }
        $tags = Tag::all();
        $post_order = $request->input('sort_order', 'newest', 'oldest');
        
        if ($post_order === 'oldest') {
        $query->orderBy('released_date', 'asc'); // 古い順
        } else {
        $query->orderBy('released_date', 'desc'); // デフォルトは新しい順
        }
        $posts = $query->paginate(8);

        return view('posts.search_source_story', compact('posts', 'keyword', 'title_keyword', 'author_keyword', 'start_year', 'end_year','tags', 'selected_tags', 'post_id'));
    }
    
    public function addSourceStory(Request $request, Post $post, Source_story $source_story)
    {
        $source_story->senior_post_id = $request['senior_post_id'];
        $source_story->post_id = $request['post_id']; 
        
        $source_story->save();

        return redirect()->route('post.show', ['post' => $post->id]);
    }
    
//   <--子作品inspiredbystory-->
    public function searchInspiredByStory(Request $request)
    {
        $keyword = $request->input('keyword');
        $title_keyword =$request->input('title_keyword');
        $author_keyword = $request->input('author_keyword');
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');
        $selected_tags = $request->input('tags_array', []);
        $post_id = $request->input('post_id');
        $query = Post::query();

       // 作品名での検索
        if ($request->input('search_type') === 'title') {
            if (!empty($keyword)) {
                $query->where('title', 'LIKE', "%{$keyword}%");
            }
        }

        // 作者名での検索
        if ($request->input('search_type') === 'author') {
            if (!empty($author_keyword)) {
                $query->whereHas('creators', function ($q) use ($author_keyword) {
                    $q->where('name', 'LIKE', "%{$author_keyword}%");
                });
            }
        }

        // 年代での検索
        if ($request->input('search_type') === 'year') {
            if (!empty($start_year) && !empty($end_year)) {
                $query->whereBetween('released_date', [$start_year, $end_year]);
            }
        }
        // タグでの検索
         if ($request->input('search_type') === 'tag' && !empty($selected_tags)) {
        // $selectedTagsが空でない場合にのみ検索条件を追加
        $query->whereHas('tags', function ($q) use ($selected_tags) {
            $q->whereIn('id', $selected_tags);
        });
        }
        $tags = Tag::all();
        $post_order = $request->input('sort_order', 'newest', 'oldest');
        
        if ($post_order === 'oldest') {
        $query->orderBy('released_date', 'asc'); // 古い順
        } else {
        $query->orderBy('released_date', 'desc'); // デフォルトは新しい順
        }
        $posts = $query->paginate(8);
        
        return view('posts.search_inspired_by_story', compact('posts', 'keyword', 'title_keyword', 'author_keyword', 'start_year', 'end_year','tags', 'selected_tags','post_id'));
    }
    
    public function addInspiredByStory(Request $request, Post $post, Inspired_by_story $inspired_by_story)
    {
        $inspired_by_story->junior_post_id = $request['junior_post_id'];
        $inspired_by_story->post_id = $request['post_id']; 

        $inspired_by_story->save();

        return redirect()->route('post.show', ['post' => $post->id]);
    }


}
