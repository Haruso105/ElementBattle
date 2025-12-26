<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet"  href="style.css" />
<title>
選択
</title>
</head>
<body bgcolor="floralwhite">
<h1 align=center>行動選択</h1>
<h3 align=center>攻撃する属性を選択しよう</h3>
<?php

   session_start();
   //各ステータスを受け取る
   $playerHP = $_SESSION['playerHP'] ?? 10;        //プレイヤーのHP
   $name = $_SESSION['playerName'] ?? "\n";  //プレイヤーの名前
   $enemyLv = $_SESSION['enemyLv'] ?? 1;           //敵のレベル
   $enemyImg = $_SESSION['enemyImg'] ?? 0;           //敵の画像
   $enemyHP = $_SESSION['enemyHP'] ?? 0; //敵のHP
   $AtkF = $_SESSION['AtkF'] ?? 5;                 //火属性の攻撃力
   $AtkG = $_SESSION['AtkG'] ?? 5;                 //草属性の攻撃力
   $AtkW = $_SESSION['AtkW'] ?? 5;                 //水属性の攻撃力
   
   unset($_SESSION['playerHP']);
   unset($_SESSION['playerName']);
   unset($_SESSION['enemyLv']);
   unset($_SESSION['enemyHP']);
   unset($_SESSION['AtkF']);
   unset($_SESSION['AtkG']);
   unset($_SESSION['AtkW']);
   unset($_SESSION['enemyImg']);
   
   if($enemyHP <= 0) $enemyHP = rand($enemyLv+($enemyLv*2), (($enemyLv*2)*3));
   if($enemyImg == 0) $enemyImg = rand(1,8);
   if($playerHP <= 0) $playerHP = 10;
   
   //プレイヤーの名前を受け取る
   if(!isset($_POST['playerName'])){
      if(empty($name))
      $name = 'プレイヤー';
   } else $name = $_POST['playerName'];

   //名前を修正
   if(empty($name)) $name = 'プレイヤー'; //空白ならプレイヤーに変更
   else if(mb_strlen($name) > 10) $name = mb_substr($name, 0, 10);   //10文字以下

   // 火属性のダメージを計算
   function fireElement($x){
      $x = $x - 4;
      $x = number_format($x, 1);
      $x = 1+(0.2*$x);
      if($x>5) $x = 5;
      return $x;
   }
   // 草属性のダメージを計算
   function grassElement($x){
      $x = $x - 2;
      return $x;
   }
   // 水属性のダメージを計算
   function waterElement($x){
      $x = $x - 4;
      $x = $x * 3 + 22;
      if($x>70) $x = 70;
      return $x;
  }
?>

<!-- 敵と味方の情報を表示 -->
<div class="field">
      <div class="characterBox">
         <img src="./imgs/yuusya_game.png" alt="Player Image" style="height: 60%;">
               <p class="characterStatus"> <font color="green"><?php echo $name; ?></font><br>
               <font color="green" size=4>HP:<?php echo $playerHP; ?></font><br>
               <br></p>
      </div>
      <img src="./imgs/text_versus_vs.png" alt="vs Image" style="height: 30%;">
      <div class="characterBox">
         <img src="./imgs/enemy/<?php echo $enemyImg; ?>.png" alt="Monster Image" style="height: 60%;">
         <p class="characterStatus"> <font color="red">敵モンスター</font><br>
         <font color="red" size=4>HP:<?php echo $enemyHP; ?></font><br>
         <font color="red" size=4>Lv:<?php echo $enemyLv; ?></font>
      </div>
</div>

<!-- ---------------------ページ遷移処理------------------------ -->
<form action="battle.php" method="post"> 

   <div class="field">
      <button type="button" class="card " data-value="1" id="fireBtn" onclick="changeElement(1)">
         <img src="./imgs/fire.png" alt="Button Image" style="height: 50%;">
         <br><font color="red" size = 5>火属性</font><br>
         <!-- <font color="red" size = 4>攻撃力:<?php echo $AtkF; ?> </font> -->
         <font color="red" size = 4>攻撃力:<?php echo $enemyLv+4; ?> </font>
         <br><font color="red" size = 3>火力:攻撃<?php echo fireElement($AtkF); ?>倍</font>
      </button>
      <button type="button" class = "card" data-value="2" id="grassBtn" onclick="changeElement(2)">
         <img src="./imgs/grass.png" alt="Button Image" style="height: 50%;">
         <br><font color="green" size = 5>草属性</font><br>
         <!-- <font color="green" size = 4>攻撃力:<?php echo $AtkG; ?></font> -->
         <font color="green" size = 4>攻撃力:<?php echo $enemyLv+4; ?></font>
         <br><font color="green" size = 3>回復:HP+<?php echo grassElement($AtkG); ?></font>
      </button>
      <button type="button" class = "card" data-value="3" id="waterBtn" onclick="changeElement(3)">
         <img src="./imgs/water.png" alt="Button Image" style="height: 50%;">
         <br><font color="blue" size = 5>水属性</font><br>
         <!-- <font color="blue" size = 4>攻撃力:<?php echo $AtkW; ?></font> -->
         <font color="blue" size = 4>攻撃力:<?php echo $enemyLv+4; ?></font>
         <br><font color="blue" size = 3>運気:<?php echo waterElement($AtkW); ?>%で勝ち</font>
   </div>

    <div class="btn-container">
      <input type="submit" class="classBtn disabledBtn" id="attack" name="button1" value="攻撃する" disabled/>
   </div>

   <!-- -----------------隠し値の受け渡し処理--------------- -->
   <input type="hidden" value="<?php echo $playerHP ?>" name="playerHP" />
   <input type="hidden" value="<?php echo $AtkF ?>" name="AtkF" />
   <input type="hidden" value="<?php echo $AtkG ?>" name="AtkG" />
   <input type="hidden" value="<?php echo $AtkW ?>" name="AtkW" />
   <input type="hidden" value="<?php echo $name ?>" name="playerName"/>

   <input type="hidden" value="<?php echo $enemyHP ?>" name="enemyHP" />
   <input type="hidden" value="<?php echo $enemyLv ?>" name="enemyLv" />
   <input type="hidden" value="<?php echo $enemyImg ?>" name="enemyImg" />
   
   <input type="hidden" name='element_id' id="element" value=""/>
</form> 

<script>
   const btns = document.querySelectorAll('.card');
   const hiddenField = document.getElementById('element');

   // 属性のボタンが押されたら隠し値をその属性に変化
   btns.forEach(button => {
      button.addEventListener('click', function()
      {
         const selectedValue = this.getAttribute('data-value');
         hiddenField.value = selectedValue;
         this.classList.add('selected');
      });
   });

   // 選択された属性のボタンを拡大
   function changeElement(x){
      document.getElementById('attack').disabled = null;
      document.getElementById('attack').classList.remove('disabledBtn');
      document.getElementById('attack').classList.add('enableBtn');
      
      switch (x) {
         case 1:
               document.getElementById('grassBtn').classList.remove('selected');
               document.getElementById('waterBtn').classList.remove('selected');
            break;
         case 2:
               document.getElementById('fireBtn').classList.remove('selected');
               document.getElementById('waterBtn').classList.remove('selected');
            break;
         case 3:
               document.getElementById('fireBtn').classList.remove('selected');
               document.getElementById('grassBtn').classList.remove('selected');
               break;
         default:
     }
   }
</script>
</body>
</html>