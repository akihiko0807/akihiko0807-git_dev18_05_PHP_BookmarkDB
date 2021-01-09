<?php
// require_once以外にも4つくらいあるけどrequire_onceでいい
require_once('funcs.php');

//1.  DB接続します
try {
  //ID:'root', Password: 'root'
  $pdo = new PDO('mysql:dbname=ai_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

    // echo '<pre>';
    // var_dump($result);
    // echo '</pre>';

    $view .= '<p class="data_inner">' . h($result['date']) . ' /' . h($result['song1']) . ' /' . h($result['song2']) . ' /' . h($result['song3']) . ' / ' . h($result['comment']) . '</p>';
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Show Data</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <h1 class="site_title"><a href="index.html">Live Play List Questionnaire</a></h1>
  <nav class="header_nav">
    <ul class="header_nav_list">
      <a href="data.php"><li class="header_nav_item">Data</li></a>
      <a href="ranking.php"><li class="header_nav_item">Ranking</li></a>
    </ul>
  </nav>
</header>
  <h2 class="select_link_wrapper">
  </h2>
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>

</body>
</html>
