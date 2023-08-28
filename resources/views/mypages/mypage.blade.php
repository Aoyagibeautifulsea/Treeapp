    <x-app-layout>
        <div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
            <div class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}さんのマイページ</div>
            
     <div class='profile bg-white border border-gray-300 shadow-md p-6 rounded-lg'>
         <div class="text-lg font-bold text-gray-800">プロフィールの設定</div>
         <section>
    
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
    
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
    
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <div>
            <label for="adult_check" class="flex items-center">
            <input type="checkbox" id="adult_check" name="adult_check" class="mr-2" {{ $user->adult_check ? 'checked' : '' }}>
            <span>{{ __('１８歳以上ならチェックをお入れください（成人向けの作品も表示できるようになります）') }}</span>
            </label>
            </div>
            
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('保存する') }}</x-primary-button>
    
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
           <div class="UpdatePassword">
        @if (Route::has('register'))
            <x-primary-button>
                <a href="{{ route('update-password-form') }}">
                    {{ __('パスワードを変更する') }}
                </a>
            </x-primary-button>
        @endif
           </div>
            <div class="DeleteUser">
        @if (Route::has('register'))
            <x-primary-button>
                <a href="{{ route('delete-user-form') }}">
                    {{ __('アカウントを削除') }}
                </a>
            </x-primary-button>
        @endif
           </div>
           
            
        </form>
    </section>
     </div>
    
    <!--自分の投稿の表示、編集、削除-->
    <div class="text-lg font-bold text-gray-800">自分の投稿</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($user->posts as $post)
             <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                <div class='post'>
                    <h2 class='title text-lg'>
                    作品名：     <a href="/posts/{{ $post->id }}" class="text-gray-800 hover:underline">{{ $post->title }}</a>
                    </h2>
                </div>
                 <div class='creator mt-2'>
                    <h3 class='creator text-gray-600'>
                        作者名：
                        @foreach($post->creators as $creator)
                         <a href="/posts/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                        @endforeach
                    </h3>
                </div>
                <div class='buttons flex space-x-2 mt-4'>     
                    <div class='edit'>
                        <form action="{{ route('posts.edit', $post->id) }}" method="GET">
                        @csrf
                        <button type="submit" class="bg-gray-500 hover:bg-gray-600 focus:outline-none text-white py-2 px-4 rounded-full">編集</button>
                        </form>
                    </div>
                    <div class='delete'>
                        <form action="{{ route('posts.confirm', $post->id) }}" method="GET">
                         @csrf
                        <button type="submit" class="bg-gray-500 hover:bg-gray-600 focus:outline-none text-white py-2 px-4 rounded-full">削除</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    <!--いいねした投稿の表示-->
        <div class="text-lg font-bold text-gray-800">いいねした投稿</div>
            <div id='postContainer' class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @if ($likedPosts !== null)
                @foreach ($likedPosts->take(8) as $post)
                <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                    <div class='post'>
                        <h2 class='title text-lg'>
                           作品名：　 <a href="/posts/{{ $post->id }}" class="text-gray-800 hover:underline">{{ $post->title }}</a>
                        </h2>
                    </div>
                    <div class='creator mt-2'>
                        <h3 class='creator text-gray-600'>
                            作者名：
                        @foreach($post->creators as $creator)
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
            @endforeach
            @else
             <p>まだいいねした作品がありません</p>
            @endif
            <button id="loadMoreButton">もっと見る</button>
        </div>
    
            <!--タグ通知機能-->
            <div class="text-lg font-bold text-gray-800">お気に入りタグの登録</div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <p>どのような機能なのかを解説する文章</p>
                    <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    @foreach ($tags->groupBy('category') as $category => $groupedTags)
                    <h2>{{ $category }}</h2>
                    @foreach ($groupedTags as $tag)
                    <label>
                        <input type="checkbox" name="tags_array[]" value="{{ $tag->id }}" />
                        {{ $tag->name }}
                    </label>
                    @endforeach
                    @endforeach
                    <button type="submit">お気に入りタグを保存</button>
                    </form>
                </div>
            </div>
    </x-app-layout>
    
    <script>
        // ポストの配列と、表示中のポスト数を管理する変数
        var posts = @json($likedPosts);
        var displayedCount = 8;
        var loadMoreButton = document.getElementById("loadMoreButton");
    
        // 残りのポストがない場合はボタンを非表示にする
        if (displayedCount >= posts.length) {
            loadMoreButton.style.display = 'none';
        }
    
        // もっと見るボタンのクリックイベント
        document.getElementById('loadMoreButton').addEventListener('click', function () {
            var postContainer = document.getElementById("postContainer");
    
            // 次の8件を表示
            for (var i = displayedCount; i < displayedCount + 8 && i < posts.length; i++) {
            var post = posts[i];
    
            var postDiv = document.createElement('div');
            postDiv.className = 'bg-white border border-gray-300 shadow-md rounded-md p-4';
            postDiv.innerHTML = `
                 <div class='post'>
                    <h2 class='title text-lg'>
                        作品名：<a href="/posts/${post.id}" class="text-gray-800 hover:underline">${post.title}</a>
                    </h2>
                 </div>
                 <div class='creator mt-2'>
                    <h3 class='creator text-gray-600'>
                        作者名：
                        @foreach($post->creators as $creator)
                            <a href="/posts/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                        @endforeach
                    </h3>
                </div>
                <div class='buttons flex space-x-2 mt-4'>
                    <div class='wish_list'>
                        <form action="{{ route('Wish_list', ['id' => $post->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="${post.id}">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">
                                読みたいリストに追加
                            </button>
                        </form>
                    </div>
                    <div class='good'>
                        <form action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="${post.id}">
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
            `;
    
            postContainer.appendChild(postDiv);
        }
    
        displayedCount += 8;
        });
    </script>