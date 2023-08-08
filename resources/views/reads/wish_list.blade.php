<x-app-layout>
     <h1>読みたいリスト</h1>
 <ul>
    @if ($wishPosts !== null)
        @foreach ($wishPosts as $post)
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
            <div class='wish_list'>
                <!--読みたいリストから削除-->
                 <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
            @csrf
            <button type="submit">済ボタン</button>
        </form>
            </div>
        @endforeach
    @else
   <p>作品はまだ追加されてません</p>
    @endif
    </ul>
 
</x-app-layout>