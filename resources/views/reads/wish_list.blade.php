<x-app-layout>
    <div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
        <h1 class="text-2xl font-semibold">読みたいリスト</h1>
        <ul>
            @if ($wishPosts !== null)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($wishPosts as $post)
                        <div class="bg-white border border-gray-300 shadow-md rounded-md p-4">
                            <div class='post'>
                                <h2 class='title text-lg'>
                                    <a href="/posts/{{ $post->id }}" class="text-gray-800 hover:underline">{{ $post->title }}</a>
                                </h2>
                            </div>
                            <div class='creator mt-2'>
                                <h3 class='creator text-gray-600'>
                                    @foreach($post->creators as $creator)
                                        <a href="/posts/{{ $creator->id }}" class="text-gray-800 hover:underline">{{ $creator->name }}</a>
                                    @endforeach
                                </h3>
                            </div>   
                            <div class='wish_list mt-4'>
                                <!-- 読みたいリストから削除 -->
                                <form action="{{ route('Wish_list', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 focus:outline-none text-white py-2 px-4 rounded-full">済ボタン</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>作品はまだ追加されてません</p>
            @endif
        </ul>
    </div>
</x-app-layout>