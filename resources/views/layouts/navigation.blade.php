<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <img src="{{ asset('images/image03.JPG') }}" width="170">
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link class="font-bold text-gray-900" :href="route('toppage')" :active="request()->routeIs('toppage')">
                        {{ __('トップページ') }}
                        </x-nav-link>
                     <x-nav-link class="font-bold text-gray-900" :href="route('create')" :active="request()->routeIs('create')">
                        {{ __('作品を追加') }}
                     </x-nav-link>
                     <x-nav-link class="font-bold text-gray-900" :href="route('wish_list.view')" :active="request()->routeIs('wish_list.view')">
                        {{ __('読みたいリスト') }}
                     </x-nav-link>
                     <x-nav-link class="font-bold text-gray-900" :href="route('showmypage')" :active="request()->routeIs('showmypage')">
                        {{ __('マイページ') }}
                    </x-nav-link>
                    <x-nav-link class="font-bold text-gray-900" :href="route('howtouse')" :active="request()->routeIs('howtouse')">
                        {{ __('このサイトの使い方') }}
                    </x-nav-link> 
                    <div class=" p-4">
                    @auth
                        <!-- ログインしている場合のコンテンツ（ログアウトボタン） -->
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link class="font-bold text-gray-900" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('ログアウト') }}
                        </x-nav-link>
                        </form>
                    @else
                        <!-- ログインしていない場合のコンテンツ（ログインボタン） -->
                        <a href="{{ route('login') }}" class="btn btn-secondary font-bold text-gray-900" role="button">
                            {{ __('ログイン') }}
                        </a>
                    @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<main>
@yield('child')
</main>