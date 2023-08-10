<x-app-layout>
<h1>Delete Post</h1>

    <p>本当に投稿を削除してよろしいですか？</p>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">投稿を削除する</button>
    </form>

    <a href="{{ route('backmypage') }}">戻る</a>
 </x-app-layout>