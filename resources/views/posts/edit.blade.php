<x-app-layout>
<h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="title">
                <h1>作品タイトル</h1>
                <input type="text" name="post[title]" placeholder="作品名を入力してください" value="{{ $post->title }}" />
                  <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
       <div class='creator'>
           <h2>作者</h2>
           @foreach($post->creators as $creator)
           <input type="text" name="name" placeholder="作者名を入力してください" value="{{ $creator->name }}"/>
           <p class="title__error" style="color:rd">{{ $errors->first('name') }}</p>
           @endforeach
                  
            </div>
            <div clsss='released_date'>
                <h3>作品が発表された年</h3>
                <input type="number" name="post[released_date]" min="1" max="9999" step="1" placeholder="作品が発表された年を半角数字で入力してください" value="{{ $post->released_date}}"/>
                  <p class="title__error" style="color:red">{{ $errors->first('post.released_date') }}</p>
            </div>
            
            <div class='comment'>
                <h4>作品解説</h4>
                <input type="text" name="post[explanation]" placeholder="作品に関するっコメントを入力してください" value="{{ $post->explanation}}"/>
                  <p class="title__error" style="color:red">{{ $errors->first('post.explanation') }}</p>
            </div>
            
            <div class='link'>
    <h5>外部リンク</h5>
    @if ($post->links->isEmpty())
        <input type="text" name="external_link" placeholder="作品に関するリンクを入力してください（任意）" value=""/>
        <p class="title__error" style="color:red">{{ $errors->first('external_link') }}</p>
    @else
        @foreach ($post->links as $link)
            <input type="text" name="external_link" placeholder="作品に関するリンクを入力してください（任意）" value="{{ $link->external_link }}"/>
            <p class="title__error" style="color:red">{{ $errors->first('external_link') }}</p>
        @endforeach
    @endif
</div>

<div class='link_explanation'>
    <h6>リンクの解説</h6>
    @if ($post->links->isEmpty())
        <input type="text" name="external_link_explanation" placeholder="リンクの解説を入力してください（任意）" value=""/>
        <p class="title__error" style="color:red">{{ $errors->first('external_link_explanation') }}</p>
    @else
        @foreach ($post->links as $link)
            <input type="text" name="external_link_explanation" placeholder="リンクの解説を入力してください（任意）" value="{{ $link->external_link_explanation}}"/>
            <p class="title__error" style="color:red">{{ $errors->first('external_link_explanation') }}</p>
        @endforeach
    @endif
</div>
            
             <div class='tag'>
                <h7>タグの選択</h7>
                   @foreach ($tags->groupBy('category') as $category => $groupedTags)
                 <h2>{{ $category }}</h2>
                 @foreach ($groupedTags as $tag)
                 <label>
                 <input type="checkbox" name="tags_array[]" value="{{ $tag->id }}" />
                 {{ $tag->name }}
                </label>
                @endforeach
                @endforeach
            </div>
            
             <div class='image'>
                <h8>作品関連画像</h8>
                <input type="file" name="image_url" value="{{ old('image_url') }}"/>
                 <p class="image__error" style="color: red;">{{ $errors->first('image_url') }}</p>
            </div>
            
            <div class='age_limit'>
                <h9>成人向け作品の場合はチェックを入れてください</h9>
                <input type="checkbox" name="post[age_limit]" value=true @if(old('post.age_limit')) checked @endif />
            </div>
            
            <div class='ai_generate_check'>
                <h10>AI生成の作品の場合はチェックを入れてください</h10>
                <input type="checkbox" name="post[ai_generate_check]" value=true  @if(old('post.ai_generate_check')) checked @endif />
            </div>
             <button type="submit">Update Post</button>
    </form>
    </x-app-layout>