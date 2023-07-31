<x-app-layout>
<p> 表示したい内容 </p>
<div class='source_story'>
     <!--<--ここはどのようなことをする場所かの説明をする-->-->
     
      @if ($posts->count() > 0)
    <!--// $posts の要素数が 0 より大きい場合に実行するコード-->
     @else
       <p>親作品はまだ追加されていません。</p>
     @endif
     
     <a href="{{ route('search_source_story') }}">作品を探す</a>
     <!--認証されたユーザーのみ-->
     
</div>

<div class='postcontents'>
    
<div class="title">
     {{ $post->title }}
     
</div>

<div class='released_date'>
     {{ $post->released_date}}
    
</div>

<div class='creator'>
     {{ $post->creator->name}}
     
</div>
<div class='comment'>
     {{ $post->comment->body}}
     
</div>
<div class='tag'>
     <ul>
        @foreach ($post->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>

    <h2>タグの追加</h2>
    <form method="post" action="{{ route('post.updateTags', $post->id) }}">
        @csrf
        @foreach ($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                {{ $tag->name }}
            </label><br>
        @endforeach
        <button type="submit">更新</button>
    </form>
</div>

<div class='link'>
     {{ $post->link->external_link}}
     {{ $post->link->external_link_explanation}}
     
</div>
<div class='image'>
     {{ $post->image->image_path}}
     
</div>

</div>
<div class='wish_list'>
    <!--読みたいリストへの追加ボタン-->
     <form action="{{ route('wish_list.add', $post->id) }}" method="POST">
            @csrf
            <button type="submit">wish_listに追加</button>
        </form>
</div>

<div class='good'>
    <!--いいねボタン-->
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

<div class='inspired_by_story'>
      <!--<--ここはどのようなことをする場所かの説明をする-->-->
      
     @if ($posts->count() > 0)
    <!--// $posts の要素数が 0 より大きい場合に実行するコード-->
     @else
       <p>子作品はまだ追加されていません。</p>
     @endif
     
      <a href="{{ route('search_inspired_by_story') }}">作品を探す</a>
      <!--認証されたユーザーのみ-->
      
</div>      
        
        
        <div class="footer">
            <a href="/post/serch_index">戻る</a>
        </div>
<div class='review'>
     
</div>
    

</x-app-layout>