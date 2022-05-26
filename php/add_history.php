<?php 
require_once("../lib/util.php");
$gobackURL ="insertform.html";
//user
$user ='root';
$password ='';
$dbName ='history';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
try{
  $pdo = new PDO($dsn,$user,$password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  echo "データベース{$dbName}に接続しました。<br>";
  $sql = "SELECT id, name 
  FROM brand";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $brand = $stm->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e){
  echo '<span class="error">エラーがありました。</span><br>';
  echo $e->getMessage();
  exit();
}
/* 
歴史人物の情報
id(頭文字から2文字取る）
name(VARCHAERは15にする）
age(没年時の歳を打ち込む）
説明文explanation(VARCGAERは300字以内）
画像までは出さなくてもいい
*/
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <title>データベースに接続</title>
  <nav id="global">
      <ul>
        <li class="current"><a href="index.html"><img src="image/main1.jpg">メインページ</a></li>
        <li><a href="search.html"><img src="image/main2.jpg">歴史人物を検索する</a></li>
        <li><a href="chat.html"><img src="image/main3.jpg">織田信長と話そう</a></li>
        <li><a href="output.html"><img src="image/main4.jpg">.txt出力</a></li>
        <li><a href="https://github.com/StopInternet/history_search" target="_blank" ><img src="image/main5.jpg">コード</a></li>
      </ul>
    </nav>
  </head>
  <body>
    <div>
    <form method="POST" action="insert_goods.php">
        <ul>
          <li>
            <label>その歴史人物の頭文字2文字を入力してください（例:織田信長-> ON)<br>
              <input type="text" name="id" placeholder="ID">
            </label>
          </li>
          <li>
          <label>商品名：
            <input type="text" name="name" placeholder="商品名">
          </label>
          </li>
          <li>
          <label>サイズ：
            <input type="text" name="size" placeholder="(未入力でもOK)">
          </label>
          </li>
          <li>
          <label>個数：
            <input type="number" name="quantity" placeholder="半角数字">
          </label>
          </li>
          <li><input type="submit" value="追加する"></li>
        </ul>
      </form>
    </div>
  </body>  
  </html>