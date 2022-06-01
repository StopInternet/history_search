<?php
session_start();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>歴史―メーカー</title>
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
      <h1>歴史人物を登録する。</h1>
      <p name="login">
      <?php
      //ユーザー情報の表示
      echo "1時間が経過するとログイン情報は消えます<br>";
      echo "ユーザーID:".$_COOKIE["user"]."<br>";
      echo "パスワード:".$_COOKIE["password"]."<br>";
      //SESSIONが空なら無視
      if(empty($_SESSION["end"])){
      }else{
        echo $_SESSION["end"];
      }
    ?>
    </p>
    <form method="POST" action="add_history_OU.php">
      <ul><li>
        <label>人物の英頭文字2文字（例:織田信長->ON):<br>
        <input type="text" name="id" placeholder="ID" maxlength ="2" 
        value ="<?php echo $_SESSION["id"]?>">
      </label></li><li>
        <label>人物名:<br>
        <input type="text" name="name" maxlength ="16" placeholder="人物名" value ="<?php echo $_SESSION["name"]?>">
      </label></li><li>
        <label>年齢:<br>
        <input type="text" name="age" maxlength = "3" placeholder="不明の場合推定年齢" value ="<?php echo $_SESSION["age"]?>">
      </label></li><li>
        <label>説明：<br>
      <textarea name="explanation" cols ="30" 
      rows = "10" maxlength="300" placeholder="人物の説明(300字以内)">
    </textarea>
        <label></li>
          <li><input type="submit" value="追加する"></li>
        </ul>
      </form>
    </body>
</html>