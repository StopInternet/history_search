<?php
/*
user_id = his_user
password = 0053
*/
session_start();

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>歴史メーカー</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/main.css?<?php 
    //cssのキャッシュの更新
    echo date('Ymd-Hi'); ?>">
    <link rel="shortcut icon" href="../../image/icon.ico">
  </head>
  <header>
    <nav id="global">
      <ul>
        <li class="current"><a href="http://localhost/Koukasokutei3/php/index.php">
          <img src="../../image/main1.jpg">メインページ</a></li>
    
        <li><a href="http://localhost/Koukasokutei3/php/search/search.php">
          <img src="../../image/main2.jpg">歴史人物を検索する</a></li>
        
        <li><a href="http://localhost/Koukasokutei3/php/data_Base/login.php">
          <img src="../../image/main2.jpg">歴史人物を登録する</a></li>
    
        <li><a href="http://localhost/Koukasokutei3/php/oda_chat/input_chat.php">
          <img src="../../image/main3.jpg">織田信長と話そう</a></li>
        
        <li><a href="https://github.com/StopInternet/history_search" target="_blank" >
        <img src="../../image/main5.jpg">コード</a></li>
          </ul>
        </nav>
  </header>
<body>
  <h1>ログイン画面</h1>
  <form action="login_check.php" method="post">
    <label for=""><span>ユーザーID</span>
      <input type="test" name="user_id"><br>
    </label>
    <label for=""><span>パスワード</span>
      <input type="text" name="password"><br>
    </label>
    <input type="submit" value="送信" >
  </form>
  <p>
  ログインに成功すると<br>
  歴史を人物を追加できるページに飛びます。<br>
<?php
if(empty($_SESSION["logins"])){
}else{
echo $_SESSION["logins"];
}
?>
</p>
</body>
</html>