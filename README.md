<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/Aoyagibeautifulsea/Treeapp/assets/135231033/126a6648-9b6c-40a7-afc6-733e28c32140" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<p align="center"><a href="https://treeapp-5772a09752c9.herokuapp.com/">みんなで作る文学史（treeapp）</a></p>

# みんなで作る文学史（treeapp）

## このWebサイトについて

このWebサイトは、みんなで作る文学史です。みんなで作る文学史ではユーザーが文学作品などの情報を投稿でき、関連作品、作品間のつながりを一目でわかるようにしてあります。既存の文学史からより作品の情報を手に取りやすくすることにより、読書の幅を広げることができるwebサイトです。

## 制作の背景

一般的な文学史の本は古事記から新しきは宮崎駿監督の作品まで載っていますが。あくまでそれは有名な作品だけであり、すべてが載せられているわけではないこと。また、作品は個として存在するのではなく親作品、子作品など有機的なつながりによって現代まで紡がれてきたものであるが、つながりがわかりやすくまとめられているものがなく文学を読む際に発展しずらいという課題があると感じていました。
    これらの課題を解決するため、作品のつながりを分かりやすくまとめ、ユーザーがメジャーな作品からマイナーな作品まで作品情報を投稿していけるアプリとしてこのアプリを制作した。このアプリを通じて新しい本との出会いを創出され、読書の幅が広がれば良いなと願っている。

### トップページイメージ

<p align="center">
    <img src="https://github.com/Aoyagibeautifulsea/Treeapp/assets/135231033/b41a1618-68f7-4e7d-ad4b-432ddaf406fa" width="80%">
</p>

### このWebサイトの使い方

<p>このwebサイトの使い方はこちら（ https://treeapp-5772a09752c9.herokuapp.com/explanations/howtouse ）からご覧ください。</p>

 </br>

### 制作する上で工夫した点


##### ・ユーザーのニーズにこたえる様々な検索機能

<p>作品名で検索、作者名で検索、タグで検索、年代で検索を実装することで作品が探しやすいように工夫しました。特に年代で検索機能は起点となる年と終点となる年を入力して範囲検索ができるようにして、時代や期間ごとをまとめて表示できるようにしました。また、JavaScriptを使い、各検索画面を切り替えるようにしました。</p>

##### ・投稿の詳細画面にて投稿された作品と親作品、子作品のつながりが分かりやすくした点

<p>投稿（作品の内容）の上に親作品、下に子作品を配置することにより作品間のつながりを分かりやすくしました。
    また、親作品（子作品）として追加する作品を探すViewにおいてトップページ同様の検索システムを設け追加する作品に関しても探しやすくしました。</p>

<p>子作品の子作品を表示できるようにし、植物の根のように作品のつながりが視覚的に広がっていくようにして、より「treeapp」のサブタイトルにかなったものにしたいと考えているため今後改善していきたいと思います。</p>

##### ・Google API

<p>APIを用いたGoogleアカウントによるログインもできるようにしたことで、ユーザー登録の利便性を向上させました。</p>

##### ・豊富な関連作品の表示

<p>１つの投稿に対して、その投稿が持つタグごとの関連作品を表示させることにより、ユーザーが今まで知らなかった作品と出会いやすくなると考えています。</p>

##### ・トップページにてお気に入りに登録したタグを含む投稿の表示

<p>マイページにてユーザーがカテゴリ及びタグ一覧から自由に選び、お気に入りタグとして追加することによりトップページの画面で、選んだタグを含む作品が表示されるようになり、自分が好きなジャンルの作品を見つけやすいようにしています。</p>

##### ・読みたいリストの実装

<p>既存の著名アプリにおいていいね機能を後で見るために使うケースが自分を含め、自分の周辺において多い傾向がありました。なのでいいねとは別に読みたいリストを作ることで使い分けができるようにしました</p>

<p>これらの他にも、いいね機能や、自分の投稿の編集及び削除、編集後も投稿に対するコメントが保持される点なども工夫した点です。</p>

### 環境

 <p>・AWS</p>
 
 <p>・Laravel 9.52.10</p>
 
  </br>

### ER図

<img src="https://github.com/Aoyagibeautifulsea/Treeapp/assets/135231033/8b8e6e8f-4628-4932-9c5a-3443f9292a57">

</br>

### 制作者情報

<p>作成：青柳美海斗</p>
 <p>お問い合わせは（moekawakoyoi@gmail.com)にお願いいたします。</p>
 
</br>
