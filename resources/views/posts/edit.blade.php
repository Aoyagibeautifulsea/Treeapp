<x-app-layout>
    <div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
        <div class="text-2xl font-bold text-gray-800">作品を編集する</div>
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="title">
                <h1 class="text-lg font-semibold">作品タイトル</h1>
                <input type="text" name="post[title]" placeholder="作品名を入力してください" value="{{ $post->title }}" />
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <div class='creator'>
                <h2 class="text-lg font-semibold">作者</h2>
                <div class="creator-forms flex space-x-2">
                    @foreach($post->creators as $creator)
                        <input type="text" name="creator_name[]"  placeholder="作者名を入力してください" value="{{ $creator->name }}"/>
                        <p class="title__error" style="color:rd">{{ $errors->first('name') }}</p>
                    @endforeach
                </div>      
            </div>
            
            <div clsss='released_date'>
                <h3 class="text-lg font-semibold">作品が発表された年</h3>
                <input type="number" name="post[released_date]" min="1" max="9999" step="1" placeholder="作品が発表された年を半角数字で入力してください" value="{{ $post->released_date}}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.released_date') }}</p>
            </div>
            
            <div class='comment'>
                <h4 class="text-lg font-semibold">作品解説</h4>
                <textarea name="post[explanation]" rows="4" class="w-full px-3 py-2 border rounded-lg" placeholder="作品に関するっコメントを入力してください">{{ $post->explanation}}</textarea>
                <p class="title__error" style="color:red">{{ $errors->first('post.explanation') }}</p>
            </div>
            <div class="flex space-x-8">
                <div class='link'>
                    <h5 class="text-lg font-semibold">外部リンク</h5>
                    @if ($post->links->isEmpty())
                        <input type="text" name="external_link[]" placeholder="作品に関するリンクを入力してください（任意）" value=""/>
                        <p class="title__error" style="color:red">{{ $errors->first('external_link') }}</p>
                    @else
                    @foreach ($post->links as $link)
                        <input type="text" name="external_link[]" placeholder="作品に関するリンクを入力してください（任意）" value="{{ $link->external_link }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('external_link') }}</p>
                    @endforeach
                    @endif
                </div>

                <div class='link_explanation'>
                    <h6 class="text-lg font-semibold">リンクの解説</h6>
                    @if ($post->links->isEmpty())
                        <input type="text" name="external_link_explanation[]" placeholder="リンクの解説を入力してください（任意）" value=""/>
                        <p class="title__error" style="color:red">{{ $errors->first('external_link_explanation') }}</p>
                    @else
                    @foreach ($post->links as $link)
                        <input type="text" name="external_link_explanation[]" placeholder="リンクの解説を入力してください（任意）" value="{{ $link->external_link_explanation}}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('external_link_explanation') }}</p>
                    @endforeach
                    @endif
                </div>
            </div>
            
            <div class='tag'>
                <h7 class="text-lg font-semibold">タグの選択</h7>
                @foreach ($tags->groupBy('category') as $category => $grouped_tags)
                    <h2>{{ $category }}</h2>
                    @foreach ($grouped_tags as $tag)
                    <label>
                    <input type="checkbox" name="tags_array[]" value="{{ $tag->id }}" />
                    {{ $tag->name }}
                    </label>
                    @endforeach
                @endforeach
            </div>
            
            <div class="flex flex-col space-y-2">
                <div class='image'>
                    <h8 class="text-lg font-semibold">作品関連画像</h8>
                    <input type="file" name="image_url" value="{{ old('image_url') }}"/>
                    <p class="image__error" style="color: red;">{{ $errors->first('image_url') }}</p>
                </div>
            </div>
            
            <div class='age_limit'>
                <h9 class="text-lg font-semibold">成人向け作品の場合はチェックを入れてください</h9>
                <input type="checkbox" name="post[age_limit]" value=true @if(old('post.age_limit')) checked @endif />
            </div>
             
            <button type="submit" class="bg-gray-500 hover:bg-gray-600 focus:outline-none text-white py-2 px-4 rounded-full">更新する</button>
            </form>
    </div>
</x-app-layout>