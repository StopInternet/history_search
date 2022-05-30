<?php
  //前提処理
require_once("../../lib/util.php");
$_POST = es($_POST);
?>
<?php
$filelog = "search_log.txt";
try {
  $fileObj = new SplFileObject($filelog,"wb");
} catch (Exception $e){
  echo '<span calss = "error">エラーがありました。</span>';
  $err = $e->getMesseage();
  exit($err);
}
  //情報を取得
  $name = $_POST['history_name'];
  //データベースに接続
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
    WHERE :history_name = id
    ";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':history_name',$_POST['history_name'],PDO::PARAM_STR);
    $stm->execute();
    $result =  $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row){
      $name0 = "名前：".es($row['name']). PHP_EOL;
      $age0 = "年齢：".es($row['age'])."歳". PHP_EOL;
      $explanation0 = "説明：".PHP_EOL.es($row['explanation']). PHP_EOL;
      $fileObj->flock(LOCK_EX);
      $name1 = $fileObj->fwrite($name0);
      $age1 = $fileObj->fwrite($age0);
      $explanation0 = $fileObj->fwrite($explanation0);
      $fileObj->flock(LOCK_UN);
    }
    echo "</tbody>";
    echo "</table>";
  }catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
    exit();
  }
  //処理終了時に元のページに返す
$url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);header("Location:". $url . "/search.php");
exit();
?>