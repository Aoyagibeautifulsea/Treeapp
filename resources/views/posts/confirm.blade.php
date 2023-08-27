<x-app-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-2 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold mb-4">投稿を削除する</h1>
            <p class="mb-6">本当に投稿を削除してよろしいですか？</p>

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-full">
                    投稿を削除する
                </button>
            </form>

            <a href="{{ route('backmypage') }}" class="mt-4 block text-blue-500 hover:text-blue-600">戻る</a>
        </div>
    </div>
</x-app-layout>