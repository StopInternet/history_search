<?php
//戻り処理
require_once("../../lib/back.php");

//データベースのセットアップ
//データベースに接続
$user = 'root';
$password = '';
$dbName = 'history';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
try {
    $pdo3 = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    echo $msg;
}

session_start();
//POST情報を管理
$ids = $_POST["id"];
$names =  $_POST["name"];
$ages =  $_POST["age"];
$exps =  $_POST["explanation"];
//セッションを管理
$_SESSION["id"] = $ids;
$_SESSION["name"] = $names;
$_SESSION["age"] = $ages;
$_SESSION["explanation"] = $exps;

//空文字がある場合
$air_in = [];
if(empty($_POST["id"]) OR 
   empty($_POST["name"]) OR 
   empty($_POST["age"]) OR 
   empty($_POST["explanation"])){
  $air_in[] = "未入力情報があります";
  back_4();
} else {
  //値が正しく入力されている場合
  $pdo3 -> beginTransaction();
  //追加するSQL文
  $sql1 = 
  "INSERT INTO history_name (id,name,age,explanation) 
   VALUES (:id,:name,:age,:explanation)";
   //追加処理
  $insert_his = $pdo3 -> prepare($sql1);
  $insert_his->bindValue(':id',$ids,PDO::PARAM_STR);
  $insert_his->bindValue(':name',$names,PDO::PARAM_STR);
  $insert_his->bindValue(':age',$ages,PDO::PARAM_STR);
  $insert_his->bindValue(':explanation',$exps,PDO::PARAM_STR);
  $insert_his->execute();
  $pdo3->commit();
  $_SESSION["end"] = "追加が完了しました。";
  //元のページに返す
  back_4();
}
?>
