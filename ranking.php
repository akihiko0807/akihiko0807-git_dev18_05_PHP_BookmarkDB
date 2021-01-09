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
// $sql = "select song,count(song) from ( select song1 as song from gs_bm_table where song1 is not null union all select song2 as song from gs_bm_table where song2 is not null union all select song3 as song from gs_bm_table where song3 is not null ) as x group by song order by song";
// // $count = (int)$pdo->query($sql)->fetchColumn();
// $status = $sql->execute();
// var_dump($status); // 1

$stmt = $pdo->prepare("select song,count(song) from ( select song1 as song from gs_bm_table where song1 is not null union all select song2 as song from gs_bm_table where song2 is not null union all select song3 as song from gs_bm_table where song3 is not null ) as x group by song order by count(song) desc");
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

    $view .= '<p class="song_list">' . h($result['song']) . ' / ' . h($result['count(song)']) . '票';
  }

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Ranking</title>
</head>
<body>
  <header>
    <h1 class="site_title"><a href="index.html">Live Play List Questionnaire</a></h1>
    <nav class="header_nav">
    <ul class="header_nav_list">
      <a href="data.php"><li class="header_nav_item">Data</li></a>
      <a href="ranking.php"><li class="header_nav_item">Ranking</li></a>
    </ul>
  </nav>
  </header>
  <div>
      <div class="container jumbotron"><?= $view ?></div>
  </div>
</body>
</html>