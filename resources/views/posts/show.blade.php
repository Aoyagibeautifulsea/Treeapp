<x-app-layout>
<p> 表示したい内容う </p>
<h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        <div class="footer">
            <a href="/post/serch_index">戻る</a>
        </div>

</x-app-layout>