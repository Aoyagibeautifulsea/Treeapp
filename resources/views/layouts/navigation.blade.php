<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('toppage')" :active="request()->routeIs('toppage')">
                        {{ __('トップページ') }}
                        </x-nav-link>
                     <x-nav-link :href="route('create')" :active="request()->routeIs('create')">
                        {{ __('作品を追加') }}
                     </x-nav-link>
                     <x-nav-link :href="route('wish_list.view')" :active="request()->routeIs('wish_list.view')">
                        {{ __('読みたいリスト') }}
                     </x-nav-link>
                     <x-nav-link :href="route('showmypage')" :active="request()->routeIs('showmypage')">
                        {{ __('マイページ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('howtouse')" :active="request()->routeIs('howtouse')">
                        {{ __('このサイトの使い方') }}
                    </x-nav-link> 
                    <div class=" p-4">
                    @auth
                    <!-- ログインしている場合のコンテンツ（ログアウトボタン） -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('ログアウト') }}
                        </x-nav-link>
                    </form>
                    @else
                        <!-- ログインしていない場合のコンテンツ（ログインボタン） -->
                        <a href="{{ route('login') }}" class="btn btn-secondary" role="button">
                            {{ __('ログイン') }}
                        </a>
                    @endauth
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<main>
@yield('child')
</main>