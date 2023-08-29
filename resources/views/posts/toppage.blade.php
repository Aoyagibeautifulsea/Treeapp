<x-app-layout>
<div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
    @auth
        <div class="text-2xl font-bold text-gray-800"> {{ Auth::user()->name }}さん  ようこそ </div>
    @endauth
    
    <div class='search bg-gray-100 p-4 rounded-md shadow-md'>
        <form action="{{ route('toppage') }}" method="GET" id="searchForm">
             <div class="mb-4">
                <input type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワードを入力" class="w-full p-2 rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-300">
            </div>
            <div class="mb-4">
                <select name="search_type" id="searchType" class="w-full p-2 rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-300">
                    <option value="title">作品名で検索</option>
                    <option value="tag">タグで検索</option>
                    <option value="author">作者名で検索</option>
                    <option value="year">年代で検索</option>
                </select>
            </div>
        </form>
            <!-- 作品名検索フォーム -->
            <div id="titleSearchForm" style="display: none;">
                <input type="text" name="title_keyword" value="{{ $title_keyword }}" placeholder="作品名を入力">
            </div>
    
            <!-- 作者名検索フォーム -->
            <div id="authorSearchForm" style="display: none;">
                <input type="text" name="author_keyword" value="{{ $author_keyword }}" placeholder="作者名を入力">
            </div>
    
            <!-- 年代検索フォーム -->
            <div id="yearSearchForm" style="display: none;">
                <input type="text" name="start_year" value="{{ $start_year }}" placeholder="起点となる年">
                <input type="text" name="end_year" value="{{ $end_year }}" placeholder="終点となる年">
            </div>
            <!-- タグ検索フォーム -->
             <div id="tagSearchForm" style="display: none;">
                @foreach ($tags->groupBy('category') as $category => $grouped_tags)
                    <h2>{{ $category }}</h2>
                        @foreach ($grouped_tags as $tag)
                        <label>
                            <input type="checkbox" name="tags_array[]" value="{{ $tag->id }}" @if(in_array($tag->id, $selected_tags)) checked @endif>
                            {{ $tag->name }}
                        </label>
                        @endforeach
                @endforeach
            </div>
            
             <input type="submit" value="検索" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">
        </form>
    </div>
    
    <div class="text-lg font-bold text-gray-800">投稿一覧</div>
     
    <form action="/" method="get">
    <div class="mb-4">
        <select name="sort_order" class="w-full p-2 rounded-md border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-300">
            <option value="newest">新しい順</option>
            <option value="oldest">古い順</option>
        </select>
    </div>
    <button type="submit" class="bg-gray-500 hover:bg-gray-600 focus:outline-none text-white py-2 px-4 rounded-full">並び替える</button>
    </form>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($posts as $post)
        @if ($post->age_limit == 0 || ($post->age_limit == 1 && $show_agelimit))
         <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
            <div class='post'>
                <h2 class='title text-lg'>
                     作品名：　<a href="/posts/{{ $post->id }}" class="text-gray-800 hover:underline">{{ $post->title }}</a>
                </h2>
            </div>
            <div class='creator mt-2'>
                <h3 class='creator text-gray-600'>
                    作者名：
                    @foreach($post->creators as $creator)
                     　<a href="/posts/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                    @endforeach
                </h3>
            </div>   
            <div class='buttons flex space-x-2 mt-4'>        
                <div class='wish_list'>
                <!--読みたいリストへの追加ボタン-->
                <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
                @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">読みたいリストに追加</button>
                </form>
                </div>
                    
                <div class='good'>
                    <!--いいねボタン-->
                <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none text-white py-2 px-4 rounded-full">
                        @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                            いいねを解除
                        @else
                            いいね
                        @endif
                    </button>
                </form>
                </div>
            </div>
        </div>
        @endif
        @empty
        <div class="text-gray-600">作品がありません</div>
    @endforelse
    </div>    
    <div class="flex items-center justify-center mt-6">
        {{$posts -> links('vendor.pagination.tailwind')}}
    </div>
    
    <div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
        @auth
        <div class="related-posts">
            <div class="text-lg font-bold text-gray-800">お気に入りタグに登録したタグを含む作品</div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($related_posts as $post)
                        <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                            <div class='post'>
                                <h2 class='title text-lg'>
                                    作品名：　<a href="/posts/{{ $post->id }}" class="text-gray-800 hover:underline">{{ $post->title }}</a>
                                </h2>
                            </div>
                            <div class='creator mt-2'>
                                <h3 class='creator text-gray-600'>
                                作者名：
                                @foreach($post->creators as $creator)
                                    <a href="/posts/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                                @endforeach
                                </h3>
                            </div>   
                            <div class='buttons flex space-x-2 mt-4'>           
                                <div class='wish_list'>
                                    <!--読みたいリストへの追加ボタン-->
                                    <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">読みたいリストに追加</button>
                                    </form>
                                </div>
                    
                                <div class='good'>
                                    <!--いいねボタン-->
                                    <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none text-white py-2 px-4 rounded-full">
                                    @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                                        いいねを解除
                                    @else
                                        いいね
                                    @endif
                                    </button>
                                    </form>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>        
        @endauth
    </div>
</div>
</x-app-layout>
