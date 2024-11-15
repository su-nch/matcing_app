<?php
// home.php
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>Friender</title>
<meta name="description"  content="書籍「動くWebデザインアイディア帳」のサンプルサイトです">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<!--==============レイアウトを制御する独自のCSSを読み込み===============-->
<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
<link rel="stylesheet" type="text/css"  href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/4-2-9/css/4-2-9.css">
<link rel="stylesheet" href="home_style.css">
<link rel="stylesheet" href="home.css">
</head>
<body>
<div id="splash">
<div id="splash-logo">読み込み中</div>
<!--/splash--></div>

<!-- <p><img src="home.png"  alt="" class="center-image"></p> -->
  <div class="splashbg"></div><!---画面遷移用-->
 
    <!-- <div class="shake">
      <a href="registar.php" class="home">アカウント作成</a>
      <a href="login.php" class="home">ログイン</a> -->
    <!-- </div> -->

<div class="tokutyo_title"><b>Frienderの特徴</b></div>
<div class="tokutyo">
    <div class="tokutyo1">
      <img class="gakusei" alt="特徴１" src="tokutyo1.png">
    <span class="box-title">特徴➀</span>
      <h1>日本工学院八王子専門学校に通う学生専用のマッチングサイト！</h1>
      <p>日本工学院八王子専門学校に在籍する学生ならだれでも利用ができます。
        工学院生しかいないので簡単に待ち合わせが可能です。</p>
    </div>
    <div class="tokutyo2">
    <span class="box-title">特徴➁</span>
    <img class="gakusei" alt="特徴２" src="tokutyo2.png">
    <h1>学科や趣味で繋がれる</h1>
      <p>検索機能を利用して学科で繋がったり、趣味で繋がったりとマッチングする方法は様々です。
        プロフィールには学科や趣味以外にもMBTIや出身地など細かく登録することができます。
        コメント欄もあるので自由に自分を表現してみてください！
      </p>
    </div>
    <div class="tokutyo3">
    <span class="box-title">特徴➂</span>
    <img class="gakusei" alt="特徴３" src="tokutyo3.png">
    <h1>掲示板機能</h1>
      <p>掲示板はいいねを押さなくても全員が利用できます。
        「いつもお昼を食べている友達が休んでしまった」「授業の空きコマで暇になった」時に掲示板を利用してサクッと会う約束をできます。
      </p>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/4-2-9/js/4-2-9.js"></script>
<script src="home.js"></script>

</body>
</html>