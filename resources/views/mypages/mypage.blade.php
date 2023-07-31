<x-app-layout>
 <h1>マイページ</h1>

<!--アイコン画像とプロフィール追加、編集、年齢制限機能-->

<!--自分の投稿の表示、編集、削除-->
<h2>My Posts</h2>
    <ul>
        @foreach ($user->posts as $post)
         <li>
                {{ $post->title }}
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <a href="{{ route('posts.confirm', $post->id) }}">Delete</a>
            </li>
        @endforeach
    </ul>
<!--いいねした投稿の表示-->
 <h1>My Page</h1>
    <h2>Liked Posts</h2>
    <ul>
        @foreach ($likedPosts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
<!--タグ通知機能-->

</x-app-layout>