<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset=UTF-8">
<link rel="stylesheet"  href="main.css" >
<title>
属性バトル！
</title>
</head>
<body bgcolor="floralwhite">

<form action="action.php" method="post" />

<div class="menuBox " >
  <!-- タイトルロゴ -->
  <div class="mainText">
  <img src="./imgs/fire.png" alt="element Image" style="height: 70%;">  
  <p class=""> 属性バトル！ </p>
  </div>
  <p class="midText"> 遊び方：攻撃する属性を選んで<br>相手とバトルしよう！！<br><font size=3>有利な属性で攻撃出来たらダメージが倍になるよ！</font></p>
  <!-- 3つの属性画像を表示 -->
  <div class = "img-container">
    <img src="./imgs/fire.png" alt="element Image" class="elementImg">  
    <img src="./imgs/mark_arrow_right.png" alt="element Image" width="60" height="90">  
    <img src="./imgs/grass.png" alt="element Image" class="elementImg">  
    <img src="./imgs/mark_arrow_right.png" alt="element Image" width="60" height="90">  
    <img src="./imgs/water.png" alt="element Image" class="elementImg">  
    <img src="./imgs/mark_arrow_right.png" alt="element Image" width="60" height="90">  
    <img src="./imgs/fire.png" alt="element Image" class="elementImg">  
  </div>

  <!-- プレイヤー名を送る -->
  <div class="midText">
    プレイヤー名を入力してね
    <br>
    <input type="text" class = "menuItems textBox" name="playerName" value="プレイヤー" />
  </div>

  <input type="submit" class = "sbtn" value="ゲームスタート" />
</div >
</form>
</body>
</html>
