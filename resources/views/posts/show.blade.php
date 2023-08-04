<x-app-layout>
<p> 表示したい内容 </p>
<div class='source_story'>
     <!--<--ここはどのようなことをする場所かの説明をする-->-->
     
      @if ($post->count() > 0)
    <!--// $posts の要素数が 0 より大きい場合に実行するコード-->
    
     @else
       <p>親作品はまだ追加されていません。</p>
     @endif
     
     <a href="{{ route('showsourcestory') }}">作品を探す</a>
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
     @foreach($post->creators as $creator)
    {{ $creator->name }}
     @endforeach
     
</div>
<div class='explanation'>
     {{ $post->explanation}}
     
</div>
<div class='tag'>
        @foreach ($post->tags as $tag)
            {{ $tag->name }}
        @endforeach
</div>

<div class='link'>
     @foreach ($post->links as $link)
     {{ $link->external_link}}
     {{ $link->external_link_explanation}}
     @endforeach
     
</div>
<div class='image'>
     @foreach ($post->images as $images)
     {{ $image->image_path}}
     @endforeach
     
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
      
     @if ($post->count() > 0)
    <!--// $posts の要素数が 0 より大きい場合に実行するコード-->
     @else
       <p>子作品はまだ追加されていません。</p>
     @endif
     
      <a href="{{ route('showinspiredbystory') }}">作品を探す</a>
      <!--認証されたユーザーのみ-->
      
</div>      
        
        
        <div class="footer">
            <a href="/post/serch_index">戻る</a>
        </div>
<div class='review'>
     
</div>
    

</x-app-layout>