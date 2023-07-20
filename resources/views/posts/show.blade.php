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
</div>
<div class='good'>
    <!--いいねボタン-->
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