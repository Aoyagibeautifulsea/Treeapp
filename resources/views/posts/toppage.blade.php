<x-app-layout>
<p class='text-red'>ああ</p>
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
             <div class='creator'>
                <h3 class='creator'>
                     <a href="/posts/{{ $post->creator->name }}"></a>
                </h3>
            </div>
            <!-- <div class='wish_list'>-->
                <!--読みたいリストへの追加ボタン-->
            <!--</div>-->
            <!-- <div class='good'>-->
                <!--いいねボタン-->
            <!--</div>-->
            @endforeach
 </div>
 
 <div class='paginate'>
            {{ $posts->links() }}
        </div>
</x-app-layout>
