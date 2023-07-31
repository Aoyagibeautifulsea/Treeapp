<x-app-layout>
<h1>Delete Post</h1>

    <p>Are you sure you want to delete this post?</p>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <a href="{{ route('mypage') }}">Cancel</a>
 </x-app-layout>