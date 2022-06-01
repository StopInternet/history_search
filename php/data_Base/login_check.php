<?php
session_start();
//元のページに返す処理
require_once("../../lib/back.php");
//セッションを空にしたかった
$_SESSION["logins"] = "";
//データベースに接続
$user = 'root';
$password = '';
$dbName = 'history';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
$user_id = $_POST['user_id'];
try {
    $pdo1 = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

//ログインシステムの作成
$sql1 = "SELECT * FROM login_user WHERE user_id = :id";
$pdo1 = $pdo1->prepare($sql1);
$pdo1->bindValue(':id', $user_id);
$pdo1->execute();
$result1 = $pdo1->fetch();

//パスワードの検知
//ログイン判定はセッションで管理。
if //空文字の場合
(empty($_POST['password']) OR empty($_POST['user_id'])){
    $_SESSION["logins"] = "<br>IDまたはパスワードが入力できていません";
    back_3();
} 
elseif //IDまたはパスワードが一致しなかった場合
($_POST['password'] != $result1['password'] OR
 $_POST['user_id'] != $result1['user_id']){
    $_SESSION["logins"] = "<br>IDまたはパスワードが間違えています。";
    back_3();
}
elseif //どちらも一致した場合
($_POST['password'] == $result1['password'] AND
 $_POST['user_id'] == $result1['user_id']){
    //Cookieによるidとpasswordの保存
    $cookie1 = $result1['user_id'];
    $cookie2 = $result1['password'];
    //Cookieのセットアップ　1時間立つと自動的に消える
    setcookie("user",$cookie1,time()+3600);
    setcookie("password",$cookie2,time()+3600);
    $_SESSION["logins"] = "<br>ログインに成功しました";
    go_1();
}

?>