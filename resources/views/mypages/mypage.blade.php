<x-app-layout>
 <h1>マイページ</h1>

<!--アイコン画像とプロフィール追加、編集、年齢制限機能-->

<!--自分の投稿の表示、編集、削除-->
<h2>My Posts</h2>
    <ul>
        @foreach ($user->posts as $post)
         
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
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <a href="{{ route('posts.confirm', $post->id) }}">Delete</a>
            
        @endforeach
    </ul>
<!--いいねした投稿の表示-->
 <h1>My Page</h1>
    <h2>Liked Posts</h2>
    <ul>
    @if ($likedPosts !== null)
        @foreach ($likedPosts as $post)
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
        @endforeach
    @else
    // $likedPostsがnullの場合の処理
    @endif
    </ul>
<!--タグ通知機能-->

</x-app-layout>