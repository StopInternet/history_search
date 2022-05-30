<?php
require_once("../../lib/util.php");
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>歴史人物であそぼう</title>
    <link rel="stylesheet" href="../../css/main.css?<?php 
    //cssのキャッシュの更新
    echo date('Ymd-Hi'); ?>">
    <link rel="shortcut icon" href="icon.ico"> 
  </head>
  <header>
    <nav id="global">
      <ul>
        <li class="current"><a href="http://localhost/Koukasokutei3/php/index.php">
          <img src="../../image/main1.jpg">メインページ</a></li>
    
        <li><a href="http://localhost/Koukasokutei3/php/search/search.php">
          <img src="../../image/main2.jpg">歴史人物を検索する</a></li>
    
        <li><a href="php/add_history.php">
          <img src="../../image/main2.jpg">歴史人物を登録する</a></li>
    
        <li><a href="http://localhost/Koukasokutei3/php/oda_chat/input_chat.php">
          <img src="../../image/main3.jpg">織田信長と話そう</a></li>
        
        <li><a href="https://github.com/StopInternet/history_search" target="_blank" >
        <img src="../../image/main5.jpg">コード</a></li>
          </ul>
        </nav>
  </header>
    <body>
      <h1>織田信長と話そう！</h1>
        <?php
        //チャット内容を読み込む
      $filename = "oda_chat.txt";
      try {
        $fileObj = new SplFileObject($filename,"rb");
      } catch (Exception $e){
        echo '<span calss = "error">エラーがありました。</span>';
        $err = $e->getMessage();
        exit($err);
      }
      echo "<div>";
      $fileObj->flock(LOCK_SH);
      $read_data = $fileObj->fread($fileObj->getSize());
      $fileObj->flock(LOCK_UN);

      if(!($read_data===FALSE)){
        $read_data = es($read_data);
        $read_data_br = nl2br($read_data,false);
        echo $read_data_br,"<hr>";
        echo '<a href="input_chat.php">ページトップへ</a></div>';
      } else {
        echo '<span class="error">ファイルを読み込めませんでした。</span></div>';
      }
      ?>
        <form method = "POST" action="chat.php">
          <label>話す内容を入力してね！<br>
            <textarea name="chat" cols ="25" rows="4" maxlength="500" placeholder="話す内容を入力"></textarea> </label>
            <input type="submit" type = "送信する">
    </form>
    </body>
</html>