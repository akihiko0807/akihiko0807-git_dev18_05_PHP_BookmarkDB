<?php
// ターミナルで利用しているpythonをこちらでもパスで指定して起動、対象となるファイルもパスを指定。
$command="/Users/akihiko.i/.pyenv/shims/python /Applications/MAMP/htdocs/php_05_Ito/Live_Playlist_Questionnair_2/artist_songs.py";
// echo ("<div class='loader'>Loading...</div>");
// php上からpythonファイルを開く
exec($command,$output);
// 渡ってきたデータから必要な部分だけ抜いて変数へ代入
$pyData = $output[0];
// 該当データのうち不要な文字列部分を削除
$pyDataTrim = str_replace("'", '', $pyData);
$songs = substr($pyDataTrim, 1, -1);
// 文字列を分割して配列化
$song = explode(",",$songs);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Live Play List Questionnaire</title>
</head>
<body>
  <header>
    <h1 class="site_title"><a href="index.php">Live Play List Questionnaire</a></h1>
    <nav class="header_nav">
      <ul class="header_nav_list">
        <a href="data.php"><li class="header_nav_item">Data</li></a>
        <a href="ranking.php"><li class="header_nav_item">Ranking</li></a>
      </ul>
    </nav>
  </header>
  <form action="insert.php" method="post">
    <div class="form_inner_wrapper">
      <div class="form-left">
        <div class="name-and-email flex-column">
          <div class="name-wrapper">
            Name: <br><input class="text-input no_enter_ti" type="text" name="name" required>
          </div>
          <div class="email-wrapper">
            E-mail: <br><input class="text-input no_enter_ti" type="email" name="mail" required>
          </div>
        </div>
        <div class="choices flex-column">
          <div class="choice-wrapper">
            1st: <br><input class="text-input no_enter_ti" type="text" name="song1" id="song1" placeholder="Select from list" readonly required>
          </div>
          <div class="choice-wrapper">
            2nd: <br><input class="text-input no_enter_ti" type="text" name="song2" id="song2" placeholder="Select from list" readonly required>
          </div>
          <div class="choice-wrapper">
            3rd: <br><input class="text-input no_enter_ti" type="text" name="song3" id="song3" placeholder="Select from list" readonly required>
          </div>
        </div>
      </div>
      <div class="form-right">
        <textarea class="no_enter_textarea" name="comment" rows="4" cols="40" placeholder="Other opinion(If you have)"></textarea>
        <input id="send-btn" type="submit" value="SEND">
      </div>
    </div>
  </form>

  <div class="song-btn-wrapper">
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    let songJson = <?php echo json_encode($song); ?>;
  </script>
  <script src="js/loaded.js"></script>
</body>
</html>