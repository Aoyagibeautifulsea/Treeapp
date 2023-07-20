<x-app-layout>
<h1>Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h1>作品タイトル</h1>
                <input type="text" name="post[title]" placeholder="作品名を入力してください"/>
            </div>
            
　　　　　　<div class='creator'>
　　　　　　    <h2>作者</h2>
　　　　　　    <input type="text" name="post[creator][name]" placeholder="作者名を入力してください"/>
　　　　　　</div>
　　　　　　
　　　　　　<div class='comment'>
　　　　　　    <h3>作品解説</h3>
　　　　　　    <input type="text" name="post[comment][body]" placeholder="作品に関するっコメントを入力してください"/>
　　　　　　</div>
　　　　　　
　　　　　　<div class='link'>
　　　　　　    <h4>外部リンク</h4>
　　　　　　    <input type="text" name="post[link][external_link]" placeholder="作品に関するリンクを入力してください（任意）"/>
　　　　　  </div>
　　　　　  <div class='tag'>
　　　　        <h5>タグ</h5>
　　　　　       <!--<input type="" name="post　" placeholder="タグを追加してください（任意）"/>-->
　　　　　  </div>
　　　　　  <div class='link_explanation'>
　　　　　　    <h6>リンクの解説</h6>
　　　　　　     <input type="text" name="post[link][external_link_explanation]" placeholder="リンクの解説を入力してください（任意）"/>
　　　　　　</div>
　　　　　　
　　　　　　<div class='image'>
　　　　　　    <h7>作品関連画像</h7>
　　　　　　    <input type="file" name="post[image][image_path]" >
　　　　　　</div>
　　　　　　
　　　　　　<div class='age_limit'>
　　　　　　    <h8>年齢制限</h8>
　　　　　　    <input type="checkbox" name="post[age_limit]" >
　　　　　　</div>
　　　　　　
　　　　　　<div class='ai_generate_check'>
　　　　　　    <h9>AI生成確認</h9>
　　　　　　    <input type="checkbox" name="post[ai_generate_check]" >
　　　　　　</div>
　　　　　　
　　　　　　<input type="submit" value="store"/>
　　　　　　</form>
</x-app-layout>