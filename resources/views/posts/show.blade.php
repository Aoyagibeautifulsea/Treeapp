<x-app-layout>
<p> 表示したい内容 </p>
<div class='source_story'>
     <!--<--ここはどのようなことをする場所かの説明をする-->-->
     
      @if ($post->count() > 0)
    <!--// $posts の要素数が 0 より大きい場合に実行するコード-->
    
     @else
       <p>親作品はまだ追加されていません。</p>
     @endif
     
     <a href="{{ route('serchsourcestory') }}">作品を探す</a>
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
     @foreach ($post->images as $image)
      <img src="{{ $image->image_path }}" alt="Image">
     @endforeach
     
</div>

</div>
<div class='wish_list'>
    <!--読みたいリストへの追加ボタン-->
     <form action="{{ route('Wish_list', $post->id) }}" method="POST">
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
     
      <a href="{{ route('searchinspiredbystory') }}">作品を探す</a>
      <!--認証されたユーザーのみ-->
      
</div>      
     <div class = 'related works'>
         <p>関連作品</p>
         @foreach($post->tags as $tag)
                <li>
                    <strong>{{ $tag->category }}</strong>: {{ $tag->name }}のタグを持つ作品
                </li>
                <ul>
                    @forelse($tag->posts as $relatedPost)
                        @if ($relatedPost->id !== $post->id)
                            <li><a href="/posts/{{ $relatedPost->id }}">{{ $relatedPost->title }}</a></li>
                            
                            <h1 class='creator'>
                        @foreach($relatedPost->creators as $creator)
                        <a href="/posts/{{ $creator->id }}">{{ $creator->name }}</a>
                        @endforeach
                     </h1>
                        @endif
                    @empty
                        <li>関連する作品はありません。</li>
                    @endforelse
                </ul>
            @endforeach
        </ul>
     </div>  
        
        <div class="footer">
            <a href="/post/serch_index">戻る</a>
        </div>
<div class='review'>
     
</div>
    

</x-app-layout>