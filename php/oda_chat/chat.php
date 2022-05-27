<?php
//前提処理
require_once("../../lib/util.php");
$_POST = es($_POST);
$date = date("Y/n/j G:i:s", time());

//織田信長チャット管理。名言集より抜粋
$chat = [
  1 => "くっ..なにものだっ！". PHP_EOL,
  2 => "理想を持ち、信念に生きよ。". PHP_EOL,
  3 => "攻撃を一点に集約せよ、無駄な事はするな。". PHP_EOL,
  4 => "器用というのは他人の思惑の逆をする者だ。". PHP_EOL,
  5 => "仕事は探してやるものだ。". PHP_EOL,
  6 => "今後はこの心を忘れるな。". PHP_EOL,
  7 => "何ぞ新故を論ぜん。". PHP_EOL,
  8 => "なかなか感心である。". PHP_EOL,
  9 => "死なない者は存在しない。". PHP_EOL,
  10 => "泣かぬなら殺してしまえ。". PHP_EOL,
  11 => "楽になろう。三途の川渡れば楽なれるよ".PHP_EOL,
];
//ユーザ指定
$oda = PHP_EOL."織田信長：".PHP_EOL;
$you = PHP_EOL."あなた：".PHP_EOL;
//チャット内容を決定する。
$value1 = rand(1,11);
$chat_oda = $oda.$chat[$value1];
$ststem1 = PHP_EOL."-----------". PHP_EOL;
$writedata = PHP_EOL."更新日：$date". PHP_EOL;
?>

<?php
//入力内容の処理
$isError =false;
if (isset($_POST['chat'])){
  $chat2 = trim($_POST['chat']);
  //ユーザー側のチャット内容を決定
  $chat_you = $you.$chat2;
  if($chat2 ===""){
    $isError =true;
  }
} else {
  $isError =true;
}
?>
<?php 
$filechat = "oda_chat.txt";
try {
  $fileObj = new SplFileObject($filechat,"a+b");
} catch (Exception $e){
  echo '<span calss = "error">エラーがありました。</span>';
  $err = $e->getMesseage();
  exit($err);
}
//入力内容がない場合は元のページに返す。
if(empty(trim($_POST['chat']))){
  $url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);
  header("Location:". $url. "/input_chat.php");
  exit();
}
//txtに書き込む
$fileObj->flock(LOCK_EX);
$oda_chat = $fileObj->fwrite($chat_you);
$system1_chat = $fileObj->fwrite($ststem1);
$user_chat = $fileObj->fwrite($chat_oda);
$system1_2_chat = $fileObj->fwrite($ststem1);
$system2_chat = $fileObj->fwrite($writedata);
$fileObj->flock(LOCK_UN);

//処理終了時に元のページに返す
$url = "http://". $_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']);header("Location:". $url . "/input_chat.php");
exit();
?>