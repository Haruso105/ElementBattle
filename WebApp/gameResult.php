<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet"  href="style.css" />
<title>
行動結果
</title>
</head>
<body bgcolor="floralwhite">
<h1 align=center>ゲームオーバー！</h1>
<?php

   session_start();
   //各ステータスを受け取る
  $enemyLv = $_SESSION['enemyLv'] ?? 1;           //敵のレベル

  unset($_SESSION['playerHP']);
  unset($_SESSION['playerName']);
  unset($_SESSION['enemyLv']);
  unset($_SESSION['enemyHP']);
  unset($_SESSION['AtkF']);
  unset($_SESSION['AtkG']);
  unset($_SESSION['AtkW']);
?>

<!-- ログの表示 -->
<div class="battleLog">
   <p class="resultText" >あなたはレベル<font color="red"><?php echo $enemyLv; ?></font>まで到達できた！</p>
</div>

<!-- ---------------------ページ遷移処理------------------------ -->
<form action="main_menu.php" method="post"> 

    <div class="btn-container">
      <input type="submit" class="classBtn enableBtn" name="button1" value="最初に戻る"/>
   </div>
</form> 
</body>
</html>