<?php
//前提処理
require_once("../../lib/util.php");
$_POST = es($_POST);
?>

<?php
//txtにして前回の検索結果をログに残す。
$filelog= "search_log.txt";
try {
  $fileObj = new SplFileObject($filelog,"wb");
} catch (Exception $e){
  echo '<span calss = "error">エラーがありました。</span>';
  $err = $e->getMesseage();
  exit($err);
}
//データベースに接続
$name = $_POST['history_name'];
$user = 'root';
$password = '';
$dbName = 'history';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = 
  "SELECT *
  FROM history_name
  WHERE :history_name = history_name.name
  ";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':history_name',$_POST['history_name'],PDO::PARAM_STR);
  $stm->execute();
  $result =  $stm->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row){
    $fileObj->flock(LOCK_EX);
    $names_2 = $fileObj->fwrite(es($row['name']));
    $ages_2 = $fileObj->fwrite(es($row['age']));
    $explanation_2 = $fileObj->fwrite(es($row['explanation']));
    $fileObj->flock(LOCK_UN);
  }


}catch (Exception $e) {
  echo '<span class="error">エラーがありました。</span><br>';
  echo $e->getMessage();
  exit();
}
//処理終了時に元のページに返す
$url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);header("Location:". $url . "/search.php");
exit();
?>