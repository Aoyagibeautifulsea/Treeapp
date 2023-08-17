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
        $title_Keyword =$request->input('title_keyword');
        $author_Keyword = $request->input('author_keyword');
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $selectedTags = $request->input('tags');
        $selectedTags = [];
        $user = Auth::user();
        
        $showAgeLimitOne = $request->input('show_age_limit_one', false);
        
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
       
        // $user = Auth::user(); // ログイン中のユーザーを取得する方法に変更
        
        if ($user && $user->favoritetag) {
        $tagIds = $user->favoritetag->pluck('id')->toArray();

        $relatedPosts = Post::whereHas('tags', function ($q) use ($tagIds) {
        $q->whereIn('id', $tagIds);
        })
            ->where('user_id', '!=', $user->id)
            ->inRandomOrder()
            ->limit(10)
            ->get();
    } else {
        $relatedPosts = collect();
    }
    
    if (auth()->check() && $user->adult_check === 1) {
        return view('posts.adult_check_toppage', compact('posts', 'keyword', 'title_Keyword', 'author_Keyword', 'startYear', 'endYear','tags', 'selectedTags','relatedPosts','showAgeLimitOne'));
    } else {
        return view('posts.toppage', compact('posts', 'keyword', 'title_Keyword', 'author_Keyword', 'startYear', 'endYear','tags', 'selectedTags','relatedPosts','showAgeLimitOne'));
    }
    }
}
