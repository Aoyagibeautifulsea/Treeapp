<x-app-layout>

<p> 表示したい内容う </p>
<!-- 作者名検索フォーム -->
<form action="{{ route('search') }}" method="GET">
  <input type="text" name="creator_query" placeholder="作者名で検索">
  <button type="submit">検索</button>
</form>

<!-- 作品名検索フォーム -->
<form action="{{ route('search') }}" method="GET">
  <input type="text" name="post_query" placeholder="作品名で検索">
  <button type="submit">検索</button>
</form>

<!-- 年代別検索フォーム -->
<form action="{{ route('search') }}" method="GET">
  <input type="number" name="year_query" placeholder="年代で検索">
  <button type="submit">検索</button>
</form>
　<!--タグ検索機能-->
　<form action="{{ route('search') }}" method="GET">
  <input type="number" name="year_query" placeholder="タグで検索">
  <button type="submit">検索</button>
</form>

<!-- 検索結果表示 -->
@if($posts->count() > 0)
  <ul>
    @foreach($posts as $post)
       <div class='post'>
                <h2 class='title'>
                     <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                
             <div class='creator'>
                <h3 class='creator'>
                     <a href="/posts/{{ $post->creator->name }}">
                       
                     </a>
                </h3>
            </div>
    @endforeach
  </ul>
@else
  <p>該当する結果はありません。</p>
@endif

</x-app-layout>