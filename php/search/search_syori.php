<?php
//前のページに返す処理。
require_once("../../lib/back.php");
?>
<?php
//txtファイルの読み込み
$filelog = "search_log.txt";
$fileObj = new SplFileObject($filelog,"wb");
  //情報を取得
  $name = $_POST['history_name'];
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
//SQL文の構成
$sql = 
 "SELECT *
  FROM history_name
  WHERE :history_name = id
 ";
 $insql = $pdo2->prepare($sql);
 $insql->bindValue(':history_name',$_POST['history_name'],PDO::PARAM_STR);$insql->execute();
 $result =  $insql->fetchAll(PDO::FETCH_ASSOC);
  //データベースからの情報を取り出す。
  foreach ($result as $row){
    $name0 = "名前：".$row['name']. PHP_EOL;
    $age0 = "年齢：".$row['age']."歳". PHP_EOL;
    $explanation0 = "説明：".PHP_EOL.$row['explanation']. PHP_EOL;
    $fileObj->flock(LOCK_EX);
    $name1 = $fileObj->fwrite($name0);
    $age1 = $fileObj->fwrite($age0);
    $explanation0 = $fileObj->fwrite($explanation0);
    $fileObj->flock(LOCK_UN);
}
//元のページに返す処理
back_1();
?>