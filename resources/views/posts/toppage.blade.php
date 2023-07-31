<x-app-layout>
<p class='text-red'>ああ</p>
@auth
<p> {{ Auth::user()->name }}さん　ようこそ </p>
@endauth

<div class='search'>
    <form action="{{ route('toppage') }}" method="GET">
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワードを入力">
        <select name="search_type">
            <option value="title">作品名で検索</option>
            <option value="tag">タグで検索</option>
            <option value="author">作者名で検索</option>
            <option value="year">年代で検索</option>
        </select>
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
                   
                </h3>
            </div>   
            
             <div class='wish_list'>
                <!--読みたいリストへの追加ボタン-->
                 <form action="{{ route('wish_list.add', $post->id) }}" method="POST">
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
 
</x-app-layout>
