<x-app-layout>
<p> 表示したい内容 </p>
<div class='source_story'>
     <!--<--ここはどのようなことをする場所かの説明をする-->-->
     
      @if ($post->count() > 0)
    <!--// $posts の要素数が 0 より大きい場合に実行するコード-->
    
     @else
       <p>親作品はまだ追加されていません。</p>
     @endif
     <form action="{{ route('search_source_story', ['post' => $post_id]) }}" method = "GET">
          <input type='hidden' name = "post_id" value="{{ $post->id}}" />
         <button>作品を探す</button>
         </form>
     <!--認証されたユーザーのみ-->
     
</div>
{{$post_id}}
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
    <a href='{{ $link->external_link }}'> {{ $link->external_link }}</a>
    <P>{{ $link->external_link_explanation}}</p>
     @endforeach
     
</div>
<div class='image'>
     @foreach ($post->images as $image)
      <img src="{{ $image->image_url }}" alt="画像が追加されていません">
     @endforeach
</div>

<div class='comment'>
    
    <div class="comment-form">
        <h3>コメントを投稿する</h3>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="body" rows="4" cols="50" required></textarea>
            <button type="submit">コメント投稿</button>
        </form>
    </div>

   <div class="comments-section">
        <h3>コメント一覧</h3>
        @foreach ($post->comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name }}</strong></p>
                <p>{{ $comment->body }}</p>
                
                @auth
                @if (auth()->user()->id === $comment->user_id)
                    <form action="{{ route('comments.delete', $comment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                @endif
            @endauth
            </div>
        @endforeach
    </div>
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
     
     <form action="{{ route('search_inspiredby_story', ['post' => $post_id]) }}" method = "GET">
          <input type='hidden' name = "post_id" value="{{ $post->id}}" />
         <button>作品を探す</button>
         </form>
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
                            
                            <div class='creator'>
                        @foreach($relatedPost->creators as $creator)
                        <a href="/posts/{{ $creator->id }}">{{ $creator->name }}</a>
                        @endforeach
                     </div>
                     <div class='wish_list'>
                <!--読みたいリストへの追加ボタン-->
                 <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
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
                        @endif
                    @empty
                        <li>関連する作品はありません。</li>
                    @endforelse
                </ul>
            @endforeach
        </ul>
     </div>  
    
</x-app-layout>