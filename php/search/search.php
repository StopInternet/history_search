<?php
//データベースのセットアップ
//データベースに接続
$user = 'root';
$password = '';
$dbName = 'history';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
try {
    $pdo2 = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    echo $msg;
}
//SQL文の構築
$sql4 = "SELECT id,name FROM history_name";
$stom = $pdo2->prepare($sql4);
$stom->execute();
$result =  $stom->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>歴史メーカー</title>
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
<div>
  <form method="POST" action="search_syori.php">
    <h3>歴史人物を検索する。</h3><p>
      <select name="history_name">
        <?php
        //データベースから選択上から
        foreach ($result as $row){
        echo '<option value="', $row["id"], '">', $row["name"], "</option>";
        }
        ?>
      </select>
    </p>
    <p><input type="submit" value="検索する"></p>
    <?php
        //前回の検索結果を読み込む
      $filelog = "search_log.txt";
      $fileObj = new SplFileObject($filelog,"rb");
      echo "～前回の検索ログ～<br>".PHP_EOL;
      $fileObj->flock(LOCK_SH);
      $read_data = $fileObj->fread($fileObj->getSize());
      $fileObj->flock(LOCK_UN);

      //読み込めるかの検知
      if(!($read_data===FALSE)){
        $read_data_br = nl2br($read_data,false);
        echo $read_data_br,"<hr>";
      } else {
        echo 'ファイルを読み込めませんでした。';
      }
?>
  </form>
</div>
</body>
</html>
