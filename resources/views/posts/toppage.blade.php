<x-app-layout>
<p class='text-green-800'>ああ</p>
@auth
<p> {{ Auth::user()->name }}さん　ようこそ </p>
@endauth

<div class='search'>
    <form action="{{ route('toppage') }}" method="GET" id="searchForm">
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワードを入力">
        <select name="search_type" id="searchType">
            <option value="title">作品名で検索</option>
            <option value="tag">タグで検索</option>
            <option value="author">作者名で検索</option>
            <option value="year">年代で検索</option>
        </select>

        <!-- 作品名検索フォーム -->
        <div id="titleSearchForm" style="display: none;">
            <input type="text" name="title_keyword" value="{{ $title_Keyword }}" placeholder="作品名を入力">
        </div>

        <!-- 作者名検索フォーム -->
        <div id="authorSearchForm" style="display: none;">
            <input type="text" name="author_keyword" value="{{ $author_Keyword }}" placeholder="作者名を入力">
        </div>

        <!-- 年代検索フォーム -->
        <div id="yearSearchForm" style="display: none;">
            <input type="text" name="start_year" value="{{ $startYear }}" placeholder="起点となる年">
            <input type="text" name="end_year" value="{{ $endYear }}" placeholder="終点となる年">
        </div>
        <!-- タグ検索フォーム -->
         <div id="tagSearchForm" style="display: none;">
            @foreach ($tags->groupBy('category') as $category => $groupedTags)
                <h2>{{ $category }}</h2>
                @foreach ($groupedTags as $tag)
                    <label>
                        <input type="checkbox" name="tags_array[]" value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) checked @endif>
                        {{ $tag->name }}
                    </label>
                @endforeach
            @endforeach
        </div>
        
         <input type="submit" value="検索">
    </form>
</div>


@forelse ($posts as $post)
       
         <div class='post'>
                <h2 class='title'>
                     <a href="/posts/{{ $post->id }}">{{ $post->title }}></a>
                </h2>
            </div>
             <div class='creator'>
                <h3 class='creator'>
            @foreach($post->creators as $creator)
                     <a href="/posts/{{ $creator->id }}">{{ $creator->name }}</a>
            @endforeach
                </h3>
            </div>   
            
             <div class='wish_list'>
                <!--読みたいリストへの追加ボタン-->
                 <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
            @csrf
            <button type="submit">wish_listに追加</button>
        </form>
            </div>
            
             <div class='good'>
                <!--<--いいねボタン-->-->
                 <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
            @csrf
            <button type="submit">
                @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                    いいねを解除
                @else
                    いいね
                @endif
            </button>
        </form>
            </div>
             </div>
            @empty
            <p>作品がありません</p>
            @endforelse
            
 @auth
 <div class="related-posts">
     <p>お気に入りタグに登録したタグを含む作品</p>
    @foreach ($relatedPosts as $post)
    <div class='post'>
                <h2 class='title'>
                     <a href="/posts/{{ $post->id }}">{{ $post->title }}></a>
                </h2>
            </div>
             <div class='creator'>
                <h3 class='creator'>
            @foreach($post->creators as $creator)
                     <a href="/posts/{{ $creator->id }}">{{ $creator->name }}</a>
            @endforeach
                </h3>
            </div>   
            
             <div class='wish_list'>
                <!--読みたいリストへの追加ボタン-->
                 <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
            @csrf
            <button type="submit">wish_listに追加</button>
        </form>
            </div>
            
             <div class='good'>
                <!--<--いいねボタン-->-->
                 <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
            @csrf
            <button type="submit">
                @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                    いいねを解除
                @else
                    いいね
                @endif
            </button>
        </form>
            </div>
        @endforeach
</div>
@endauth
</x-app-layout>
