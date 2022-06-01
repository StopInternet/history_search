<?php
//前のページに返す処理。
require_once("../../lib/back.php");
//更新日時の判定
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
  12 => "おちんちんすこ". PHP_EOL,
  13 => "ワシはフェラチオが得意じゃ！".PHP_EOL,
];
//ユーザ指定
$oda = PHP_EOL."織田信長：".PHP_EOL;
$you = PHP_EOL."あなた：".PHP_EOL;
//チャット内容を決定する。
$value1 = rand(1,13);
$chat_oda = $oda.$chat[$value1];
$ststem1 = PHP_EOL."-----------". PHP_EOL;
$writedata = PHP_EOL."更新日：$date". PHP_EOL;
?>
<?php 
//txtファイルの読み込み
$filechat = "oda_chat.txt";
$fileObj = new SplFileObject($filechat,"a+b");
//入力内容がない場合は元のページに返す。
if(empty(trim($_POST['chat']))){
  back();
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
back();
exit();
?>