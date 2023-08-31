<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Creator;
use App\Models\Tag;

class ToppageController extends Controller
{
    // <--最新投稿表示-->
    public function toppage(Request $request)
    {
        $keyword = $request->input('keyword');
        $title_keyword =$request->input('title_keyword');
        $author_keyword = $request->input('author_keyword');
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');
        $selected_tags = $request->input('tags_array', []);
        $user = Auth::user();
        
        $show_agelimit = $request->input('show_age_limit_one', false);
        
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
        
        if ($user && $user->favoritetag) {
            $get_favorite_tag = auth()->user()->favoritetag()->pluck('tag_id')->toArray();
            
            // お気に入りタグに関連する作品を取得
            $related_posts = Post::whereHas('tags', function ($query) use ($get_favorite_tag) {
            
            $query->whereIn('tag_id', $get_favorite_tag);
            })->inRandomOrder()
            ->limit(8)
            ->get();
        
        } else {
            $related_posts = collect();
        }
    
        if (auth()->check() && $user->adult_check === 1) {
            return view('posts.adult_check_toppage', compact('posts', 'keyword', 'title_keyword', 'author_keyword', 'start_year', 'end_year','tags', 'selected_tags','related_posts','show_agelimit'));
        } else {
            return view('posts.toppage', compact('posts', 'keyword', 'title_keyword', 'author_keyword', 'start_year', 'end_year','tags', 'selected_tags','related_posts','show_agelimit'));
        }
    }
    
    public function showExplanation()
    {
        return view('explanations.howtouse');
    }
        
}
