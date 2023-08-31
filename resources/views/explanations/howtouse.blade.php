<x-app-layout>
<div class="px-6 sm:px-10 md:px-20 lg:px-28 xl:px-36 space-y-8">
  <div class='bg-gray-200 p-4 rounded-lg shadow-md'>
    <div class='bg-white p-4 rounded-lg shadow-md'>
      <h2 class="text-xl font-semibold mb-4">目次</h2>
      <ul class="list-disc pl-6">
        <li><a href="#section-1">作品の詳細を見る</a></li>
        <li><a href="#section-2">作品を投稿する</a></li>
        <li><a href="#section-3">いいねする</a></li>
        <li><a href="#section-4">読みたいリストに追加する</a></li>
        <li><a href="#section-5">お気に入りのタグを登録して登録したタグを持つ作品とマッチングする</a></li>
        <li><a href="#section-6">マイページ（アカウントを管理する、自分の投稿を編集、削除する）</a></li>
      </ul>
    </div>
    
    <h1 id="section-1" class="text-2xl font-bold mb-4">作品の詳細を見る</h1>
    <div class='image mt-4'>  
      <img src="{{ asset('images/image07.PNG') }}">
    </div>
    <div class="list-disc pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>１　作品のタイトル</p>　
      <p>２　親作品（注１）の表示、親作品を追加するためのボタン</p>
      <p>３　作品のタイトル</p>　
      <p>４　作品の発表年</p>　
      <p>５　作者の名前</p>
      <p>６　作品の解説</p>　
      <p>７　この作品に紐づけられているタグ</p>　
      <p>８　リンク関連</p>
      <p>９　コメント投稿フォームと投稿ボタン（コメントをフォームに入力し、コメント投稿ボタンが押された際に下のコメント一覧にコメントが表示されるようになります)</p>
      <p>１０　いいねボタンと読みたいリストに追加するボタン</p>
    </div>
    <div class="list-disc pl-6 bg-white p-4 rounded-lg shadow-md">
      <P>（注１）　親作品とは投稿の元ネタ、参考にしている（しているだろう）作品を指します。親作品を追加することで作品間のつながりが明確になり作品の深い理解と新たな作品との出会いが期待されます。</P>
    </div>
    <div class='image mt-4'>
      <img src="{{ asset('images/image06.PNG') }}">
    </div>
    <div class="list-disc pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>１１　子作品（注２）の表示、子作品を追加するためのボタン</p>
      <p>１２　関連作品（関連作品は投稿が持っているタグによりランダムで４件表示されます）</p>
    </div>
    <div class="list-disc pl-6 bg-white p-4 rounded-lg shadow-md">
      <P>（注１）　子作品とは投稿を参考にしてのちに作られた作品を指します。子作品を追加することで作品間のつながりが明確になり作品の深い理解と新たな作品との出会いが期待されます。</P>
    </div>
    
    <h2 id="section-2" class="text-2xl font-bold mb-4">作品を投稿する</h2>
    <div class='image mt-4'>
      <img src="{{ asset('images/image05.PNG') }}">
    </div>
    <div class="list-disc pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>１　作品名（作品名は必須になります）</p>
      <p>２　作者名（作者名は必須になります）</p>　
      <p>３　作品が発表された年（数字での入力をお願いします。成立年不明の場合は0001を入力ください）</p>
      <p>４　作品解説（２００字以内でお願いします）</p>　
      <p>５　作品に関する外部リンクとその解説（３セット入力いただけます）</p>
      <p>６　タグの選択（）</p>
      <p>７　画像の追加（投稿する作品に関する画像を持っている場合には画像を追加できます）</p>
      <p>８　成人向け作品である場合のチェックボックス（こちらにチェックがされた場合表示が制限されます）</p>
    </div>
    
    <h3 id="section-3" class="text-2xl font-bold mb-4">いいねする</h3>
    <div class='image mt-4'>
      <img src="{{ asset('images/image08.PNG') }}">
    </div>
    <div class='image mt-4'>
      <img src="{{ asset('images/image12.png') }}">
    </div>
    <div class="pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>投稿一覧、投稿の詳細画面などにいいねボタンを設置しています。読みたいリストへ追加ボタンを押していただくとマイページにあるいいねした投稿の中に投稿が追加されます。また再度ボタンを押すと状態を解除して、マイページのいいねした投稿一覧に表示されなくなります。</p>
    </div>
    
    <h4 id="section-4" class="text-2xl font-bold mb-4">読みたいリストに追加する</h4>
    <div class='image mt-4'>
      <img src="{{ asset('images/image08.PNG') }}">
    </div>
    <div class='image mt-4'>
      <img src="{{ asset('images/image09.PNG') }}">
    </div>
    <div class="pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>投稿一覧、投稿の詳細画面などに読みたいリストへ追加ボタンを設置しています。読みたいリストへ追加ボタンを押していただくとヘッダーにある読みたいリストの中に投稿が追加されます。また再度ボタンを押すと状態を解除して、読みたいリストに表示されなくなります。</p> 
    </div>
    
    <h5 id="section-5" class="text-2xl font-bold mb-4">お気に入りのタグを登録して登録したタグを持つ作品とマッチングする</h5>
    <div class='image mt-4'>
      <img src="{{ asset('images/image10.PNG') }}">
    </div>
    <div class='image mt-4'>
      <img src="{{ asset('images/image12.png') }}">
    </div>
    <div class='image mt-4'>
      <img src="{{ asset('images/image11.png') }}">
    </div>
    <div class="pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>マイページの「お気に入りタグの登録」にてタグを選択し、お気に入りタグを保存ボタンを押していただくとトップページに登録していただいたタグを持つ作品がランダムに表示されるようになります。（お気に入りタグは何度も変更いただけます）</p> 
    </div>
    
    <h6 id="section-6" class="text-2xl font-bold mb-4">マイページ（アカウントを管理する、自分の投稿を編集、削除する）</h6>
    <div class='image mt-4'>
      <img src="{{ asset('images/image13.JPG') }}">
    </div>
    <div class="list-disc pl-6 bg-white p-4 rounded-lg shadow-md">
      <p>１　プロフィールの設定（名前とメールアドレスの変更ができます。また１８歳以上の方向けのチェックを入れていただくと成人向け作品も表示されるようになります）</p> 
      <p>２　パスワードを変更する場合はこちらのボタンを押していただくと再設定の画面に遷移します</p>
      <p>３　アカウント削除ボタン</p>
      <p>４　自分の投稿の編集ボタン（編集後もコメントは保持されます）</p>
      <p>５　自分の投稿の削除ボタン（間に削除を確認する画面が入ります。再度確認の上削除してください）</p>
    </div>
  </div>  
</div>
</x-app-layout>