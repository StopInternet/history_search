<?php
require_once("../../lib/util.php");
$user = 'root';
$password = '';
$dbName = 'history';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
try {
  $pdo = new PDO($dsn,$user,$password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT id,name FROM history_name";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result =  $stm->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  $err =  '<span class="error">エラーがありました。</span><br>';
  $err .= $e->getMessage();
  exit($err);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>歴史人物を検索する</title>
<link rel="stylesheet" href="../../css/main.css?<?php 
//cssのキャッシュの更新
echo date('Ymd-Hi'); ?>">
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
<div>
  <form method="POST" action="search_syori.php">
    <h3>歴史人物を検索する。</h3><p>
      <select name="history_name">
        <?php
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
      try {
        $fileObj = new SplFileObject($filelog,"rb");
      } catch (Exception $e){
        echo '<span calss = "error">エラーがありました。</span>';
        $err = $e->getMessage();
        exit($err);
      }
      echo "～前回の検索ログ～<br>".PHP_EOL;
      $fileObj->flock(LOCK_SH);
      $read_data = $fileObj->fread($fileObj->getSize());
      $fileObj->flock(LOCK_UN);
      if(!($read_data===FALSE)){
        $read_data = es($read_data);
        $read_data_br = nl2br($read_data,false);
        echo $read_data_br,"<hr>";
      } else {
        echo '<span class="error">ファイルを読み込めませんでした。</span></div>';
      }
?>
  </form>
</div>
</body>
</html>
