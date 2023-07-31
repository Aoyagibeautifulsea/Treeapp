<x-app-layout>
<h1>Blog Name</h1>
        <form action="{{ route('create_post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h1>作品タイトル</h1>
                <input type="text" name="post[title]" placeholder="作品名を入力してください" value="{{ old('post.title') }}"/>
                  <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
　　　　　　<div class='creator'>
　　　　　　    <h2>作者</h2>
　　　　　　    <input type="text" name="post[creator][name]" placeholder="作者名を入力してください" value="{{ old('post.creator.name') }}"/>
　　　　　　      <p class="title__error" style="color:red">{{ $errors->first('post.creator.name') }}</p>
　　　　　　</div>
　　　　　　<div clsss='released_date'>
　　　　　　    <h3>作品が発表された年</h3>
　　　　　　    <input type="number" name="post[released_date]" min="1" max="9999" step="1" placeholder="作品が発表された年を半角数字で入力してください" value="{{ old('post.released_date') }}"/>
　　　　　　      <p class="title__error" style="color:red">{{ $errors->first('post.released_date') }}</p>
　　　　　　</div>
　　　　　　
　　　　　　<div class='comment'>
　　　　　　    <h4>作品解説</h4>
　　　　　　    <input type="text" name="post[comment][body]" placeholder="作品に関するっコメントを入力してください" value="{{ old('post.comment.body') }}"/>
　　　　　　      <p class="title__error" style="color:red">{{ $errors->first('post.comment.body') }}</p>
　　　　　　</div>
　　　　　　
　　　　　　<div class='link'>
　　　　　　    <h5>外部リンク</h5>
　　　　　　    <input type="text" name="post[link][external_link]" placeholder="作品に関するリンクを入力してください（任意）" value="{{ old('post.link.external_link') }}"/>
　　　　　　      <p class="title__error" style="color:red">{{ $errors->first('post.link.external_link') }}</p>
　　　　　  </div>
　　　　　   
　　　　　   <div class='link_explanation'>
　　　　　　    <h6>リンクの解説</h6>
　　　　　　     <input type="text" name="post[link][external_link_explanation]" placeholder="リンクの解説を入力してください（任意）" value="{{ old('post.link.external_link_explanation') }}"/>
　　　　　　       <p class="title__error" style="color:red">{{ $errors->first('post.link.external_link_explanation') }}</p>
　　　　　　</div>
　　　　　　
　　　　　　 <div class='tag'>
　　　　        <h7>タグ</h7>
　　　　　       <input type="text" name="tag[name]" placeholder="タグを入力してください">
　　　　　         <p class="title__error" style="color:red">{{ $errors->first('tag.name') }}</p>
　　　　　  </div>
　　　　　  
　　　　　　<div class='image'>
　　　　　　    <h8>作品関連画像</h8>
　　　　　　    <input type="file" name="post[image][image_path]" value="{{ old('post.image.image_path') }}"/>
　　　　　　     <p class="image__error" style="color: red;">{{ $errors->first('post.image.image_path') }}</p>
　　　　　　</div>
　　　　　　
　　　　　　<div class='age_limit'>
　　　　　　    <h9>成人向け作品の場合はチェックを入れてください</h9>
　　　　　　    <input type="checkbox" name="post[age_limit]" value="{{ old('post.age_limit') }}"/>
　　　　　　</div>
　　　　　　
　　　　　　<div class='ai_generate_check'>
　　　　　　    <h10>AI生成の作品の場合はチェックを入れてください</h10>
　　　　　　    <input type="checkbox" name="post[ai_generate_check]" value="{{ old('post.ai_generate_check') }}"/ >
　　　　　　</div>
　　　　　　
　　　　　　<input type="submit" value="store"/>
　　　　　　</form>
</x-app-layout>