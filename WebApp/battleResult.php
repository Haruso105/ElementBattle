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
<h1 align=center>勝利！</h1>
<h3 align=center>レベルアップ！強化する属性を選ぼう！</h3>
<?php

   session_start();
   //各ステータスを受け取る
   $playerHP = $_SESSION['playerHP'] ?? 10;        //プレイヤーのHP
   $name = $_SESSION['playerName'] ?? "\n";  //プレイヤーの名前
   $enemyLv = $_SESSION['enemyLv'] ?? 1;           //敵のレベル
   $enemyHP = $_SESSION['enemyHP'] ?? rand($enemyLv+($enemyLv*2), intval(($enemyLv*2)*2)); //敵のHP
   $AtkF = $_SESSION['AtkF'] ?? 5;                 //火属性の攻撃力
   $AtkG = $_SESSION['AtkG'] ?? 5;                 //草属性の攻撃力
   $AtkW = $_SESSION['AtkW'] ?? 5;                 //水属性の攻撃力
   $enemyImg = $_SESSION['enemyImg'] ?? 5;                 //敵の画像情報
   
   unset($_SESSION['enemyHP']);
   unset($_SESSION['playerHP']);
   unset($_SESSION['playerName']);
   unset($_SESSION['enemyLv']);
   unset($_SESSION['AtkF']);
   unset($_SESSION['AtkG']);
   unset($_SESSION['AtkW']);
   unset($_SESSION['enemyImg']);
   
  $prevPlayerHP = $playerHP;
  $playerHP += $enemyLv+1;

  $prevEnemyLv = $enemyLv;
  $enemyLv += 1;


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

<!-- ログの表示 -->
<div class="battleLog">
   <p class="logText" >プレイヤーのHP <font color="red"><?php echo $prevPlayerHP; ?></font> → <font color="red"><?php echo $playerHP; ?></font></p>
   <p class="logText" >各属性の攻撃力 <font color="red"><?php echo $enemyLv+3; ?></font> → <font color="red"><?php echo $enemyLv+4; ?></font></p>
   <p class="logText" >敵のレベル<font color="red"><?php echo $prevEnemyLv; ?></font> → <font color="red"><?php echo $enemyLv; ?></font></p>
</div>

<!-- ---------------------ページ遷移処理------------------------ -->
<form action="updateLvUp.php" method="post"> 

   <div class="field">
      <button type="button" class="card " data-value="1" id="fireBtn" onclick="changeElement(1)">
         <img src="./imgs/fire.png" alt="Button Image" style="height: 50%;">
         <br><font color="red" size = 5>火属性</font><br>
         <!-- <font color="red" size = 4>攻撃力:<?php echo $AtkF; ?> → <?php echo $AtkF + 1; ?></font> -->
         <br><font color="red" size = 3>火力:攻撃<?php echo fireElement($AtkF); ?>→<?php echo fireElement($AtkF+1); ?>倍</font>
      </button>
      <button type="button" class = "card" data-value="2" id="grassBtn" onclick="changeElement(2)">
         <img src="./imgs/grass.png" alt="Button Image" style="height: 50%;">
         <br><font color="green" size = 5>草属性</font><br>
         <!--<font color="green" size = 4>攻撃力:<?php echo $AtkG; ?> → <?php echo $AtkG + 1; ?></font> -->
         <br><font color="green" size = 3>回復:HP+<?php echo grassElement($AtkG); ?>→+<?php echo grassElement($AtkG+1); ?></font>
      </button>
      <button type="button" class = "card" data-value="3" id="waterBtn" onclick="changeElement(3)">
         <img src="./imgs/water.png" alt="Button Image" style="height: 50%;">
         <br><font color="blue" size = 5>水属性</font><br>
         <!-- <font color="blue" size = 4>攻撃力:<?php echo $AtkW; ?> → <?php echo $AtkW + 1; ?></font> -->
         <br><font color="blue" size = 3>運気:<?php echo waterElement($AtkW); ?>→<?php echo waterElement($AtkW+1); ?>%で勝ち</font>
   </div>

    <div class="btn-container">
      <input type="submit" class="classBtn disabledBtn" id="attack" name="button1" value="決定する" disabled/>
   </div>

   <!-- -----------------隠し値の受け渡し処理--------------- -->
   <input type="hidden" value="<?php echo $playerHP ?>" name="playerHP" />
   <!-- <input type="hidden" value="<?php echo $enemyHP ?>" name="enemyHP" /> -->
   <input type="hidden" value="<?php echo $enemyLv ?>" name="enemyLv" />
   <input type="hidden" value="<?php echo $AtkF ?>" name="AtkF" />
   <input type="hidden" value="<?php echo $AtkG ?>" name="AtkG" />
   <input type="hidden" value="<?php echo $AtkW ?>" name="AtkW" />
   <input type="hidden" value="<?php echo $name ?>" name="playerName"/>
   
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

<a href="main_menu.php">最初のページに戻る</a>
</body>
</html>