<?php
//元のページに返す処理
//chatページ
function back(){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/input_chat.php");
}

//検索ページ
function back_1(){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/search.php");
}

//タイマーページ
function back_2(){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/timer.php");
}

//ログインページ
function back_3(){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/login.php");
}

//セッションのやつ
function back_4(){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/add_history.php");
}
//追加ページに飛ばす
//ログインページ
function go_1(){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/add_history.php");
}
?>