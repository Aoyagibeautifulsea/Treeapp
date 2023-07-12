<x-app-layout>
<p>ああ</p>
@auth
<p> {{ Auth::user()->name }}さん　ようこそ </p>
@endauth
 <div class='posts'>
            @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>
                     <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
            </div>
            @endforeach
 </div>
 <div class='paginate'>
            {{ $posts->links() }}
        </div>
</x-app-layout>
