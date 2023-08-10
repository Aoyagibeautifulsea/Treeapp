<x-app-layout>
 <h1>マイページ</h1>
 <div class='profile'>
     <h>プロフィールの設定</h>
     <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

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

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
<h1>自分の投稿</h1>
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
    <h2>いいねした投稿</h2>
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
     <p>まだいいねした作品がありません</p>
    @endif
    </ul>
<!--タグ通知機能-->
<h3>お気に入りタグの登録</h3>
　<p>どのような機能なのかを開設する文章</p>
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

</x-app-layout>