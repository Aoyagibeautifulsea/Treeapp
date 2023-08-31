<x-app-layout>
    <div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
        
        <div class='postcontents bg-white p-4 rounded-lg shadow-md mt-4'>
            <div class="text-2xl font-bold text-gray-800">{{ $post->title }}</div>
        </div>
         
        <div class="text-lg font-bold text-gray-800">  {{ $post->title }}の親作品 </div>
            <div class='source_story'>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($post->sourcestories as $source_story)
                        <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                            <div class='post'>
                                <h2 class='title text-lg'>
                                    作品名：　<a href="/posts/{{ $source_story->id }}" class="text-gray-800 hover:underline">{{ $source_story->title }}</a>
                                </h2>
                            </div>
                            <div class='creator mt-2'>
                                <h3 class='creator text-gray-600'>
                                    作者名；
                                @foreach($source_story->creators as $creator)
                                    <a href="/creators/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                                @endforeach
                                </h3>
                            </div>
                            <div class='buttons flex space-x-2 mt-4'>    
                                <div class='wish_list'>
                                    <!--読みたいリストへの追加ボタン-->
                                    <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">読みたいリストに追加</button>
                                    </form>
                                </div>
                    
                                <div class='good'>
                                    <!--いいねボタン-->
                                    <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none text-white py-2 px-4 rounded-full">
                                    @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                                        いいねを解除
                                    @else
                                        いいね
                                    @endif
                                    </button>
                                    </form>
                                 </div>
                            </div>
                        </div>
                    @empty
                        <p>親作品はまだ追加されていません。</p>
                    @endforelse
                </div>
            </div>

            <form action="{{ route('search_source_story', ['post' => $post_id]) }}" method = "GET">
            <input type='hidden' name = "post_id" value="{{ $post->id}}" />
            <button class="bg-gray-500 hover:bg-gray-600 focus:outline-none text-white py-2 px-4 rounded-full">追加する親作品を探す</button>
            </form>
     
            <div class='postcontents bg-gray-200 p-4 rounded-lg shadow-md'>
                <div class="title text-xl font-semibold mt-4">
                    {{ $post->title }}
                </div>
            
                <div class='released_date mt-2'>
                    <h class="text-lg font-semibold">作品が発表された年</h>
                    {{ $post->released_date}}
                
                </div>
            
                <div class='creator mt-2'>
                    <h class="text-lg font-semibold">作者</h>
                    @foreach($post->creators as $creator)
                        {{ $creator->name }}
                    @endforeach
                 
                </div>
                <div class='explanation mt-4'>
                    <h class="text-lg font-semibold">作品解説</h>
                    {{ $post->explanation}}
                 
                </div>
                <div class='tag mt-2'>
                    <h class="text-lg font-semibold">この作品に紐付けられているタグ</h>
                    @foreach ($post->tags as $tag)
                         <span class="bg-gray-300 px-2 py-1 rounded-lg text-sm text-gray-700">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <div class="link mt-4">
                    <h class="text-lg font-semibold">この作品に関連するリンクとリンクの解説</h>
                    <div class='mt-4'>
                        @foreach ($post->links as $link)
                            <a href='{{ $link->external_link }}' class="text-blue-600 hover:underline"> {{ $link->external_link }}</a>
                            <P class="text-gray-600">{{ $link->external_link_explanation}}</p>
                        @endforeach
                    </div>
                </div>
                <div class='image mt-4'>
                    @foreach ($post->images as $image)
                        <div class="max-w-full p-6">
                            <img src="{{ $image->image_url }}" alt="画像が追加されていません" class="max-w-full">
                        </div>
                    @endforeach
                </div>
            
                <div class='comment mt-4'>
                    <div class="comment-form">
                        <h class="text-lg font-semibold">コメントを投稿する</h>
                        <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="body" rows="4" class="w-full px-3 py-2 border rounded-lg" required></textarea>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg mt-2">コメント投稿</button>
                        </form>
                    </div>
            
                    <div class="comments-section mt-4">
                        <h class="text-lg font-semibold">コメント一覧</h>
                        <div class="bg-white p-4 space-y-4 ">
                            @foreach ($post->comments as $comment)
                                <div class="comment-container">
                                    <div class="comment">
                                        <p class="text-gray-600"><strong>{{ $comment->user->name }}</strong></p>
                                        <p>{{ $comment->body }}</p>
                                        @auth
                                            @if (auth()->user()->id === $comment->user_id)
                                                <form action="{{ route('comments.delete', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline mt-1">削除</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <div class="flex  mt-4">
                    <div class='wish_list'>
                        <!--読みたいリストへの追加ボタン-->
                        <form action="{{ route('Wish_list', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">読みたいリストに追加</button>
                        </form>
                    </div>
            
                    <div class='good'>
                        <!--いいねボタン-->
                        <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none text-white py-2 px-4 rounded-full">
                            @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                                いいねを解除
                            @else
                                いいね
                            @endif
                        </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-lg font-bold text-gray-800">  {{ $post->title }}の子作品 </div>
                <div class='source_story'>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse ($post->inspiredbystories as $inspired_by_story)
                            <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                                <div class='post'>
                                    <h2 class='title text-lg'>
                                        作品名：　<a href="/posts/{{ $inspired_by_story->id }}" class="text-gray-800 hover:underline">{{ $inspired_by_story->title }}</a>
                                    </h2>
                                </div>
                                <div class='creator mt-2'>
                                    <h3 class='creator text-gray-600'>
                                        作者名：
                                    @foreach($inspired_by_story->creators as $creator)
                                        <a href="/creators/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                                    @endforeach
                                    </h3>
                                </div>
                                <div class='buttons flex space-x-2 mt-4'>    
                                    <div class='wish_list'>
                                        <!--読みたいリストへの追加ボタン-->
                                        <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">読みたいリストに追加</button>
                                        </form>
                                    </div>
                        
                                    <div class='good'>
                                        <!--いいねボタン-->
                                        <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none text-white py-2 px-4 rounded-full">
                                        @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                                            いいねを解除
                                        @else
                                            いいね
                                        @endif
                                        </button>
                                        </form>
                                     </div>
                                </div>
                            </div>
                        @empty
                            <p>親作品はまだ追加されていません。</p>
                        @endforelse
                    </div>
                </div> 
                <form action="{{ route('search_inspiredby_story', ['post' => $post_id]) }}" method = "GET">
                     <input type='hidden' name = "post_id" value="{{ $post->id}}" />
                     <button class="bg-gray-500 hover:bg-gray-600 focus:outline-none text-white py-2 px-4 rounded-full">追加する子作品を探す</button>
                </form>
                 
                <div class = 'related works'>
                    <div class="text-lg font-bold text-gray-800">関連作品</div>
                        @foreach($post->tags as $tag)
                                <li class="text-lg text-gray-800">
                                    <strong>{{ $tag->category }}: {{ $tag->name }}のタグを持つ作品</strong>
                                </li>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                    @forelse($tag->posts->where('id', '<>', $post->id)->shuffle()->take(4) as $relatedPost)
                                        @if ($relatedPost->id !== $post->id)
                                            <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                                                <div class='post'>
                                                    <h2 class='title text-lg'>
                                                        作品名：　<a href="/posts/{{ $relatedPost->id }}" class="text-gray-800 hover:underline">{{ $relatedPost->title }}</a>
                                                    </h2>
                                                </div>
                                                <div class='creator mt-2'>
                                                    <h3 class='creator text-gray-600'>
                                                        作者名：
                                                    @foreach($relatedPost->creators as $creator)
                                                        <a href="/posts/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                                                    @endforeach
                                                    </h3>
                                                </div>
                                                <div class='buttons flex space-x-2 mt-4'>    
                                                    <div class='wish_list'>
                                                        <!--読みたいリストへの追加ボタン-->
                                                        <form action="{{ route('Wish_list',  ['id' => $post->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">読みたいリストに追加</button>
                                                        </form>
                                                    </div>
                                
                                                    <div class='good'>
                                                        <!--いいねボタン-->
                                                        <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500 hover:bg-red-600 focus:outline-none text-white py-2 px-4 rounded-full">
                                                        @if ($post->favoritedBy()->where('user_id', auth()->id())->exists())
                                                            いいねを解除
                                                        @else
                                                            いいね
                                                        @endif
                                                        </button>
                                                        </form>
                                                     </div>
                                                </div>
                                            </div>
                                            @endif
                                    @empty
                                        <p class="text-lg text-gray-800">関連する作品はありません。</p>
                                    @endforelse
                                </div>
                        @endforeach
                    </div>
                </div>  
    </div>
</x-app-layout>