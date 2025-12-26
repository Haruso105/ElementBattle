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
<h1 align=center>攻撃結果</h1>
<?php
   //-----------各種値の受け取り-------------
   //プレイヤー名
   if(!isset($_POST['playerName'])){
      echo '<p> playerName受け取れませんでした </p>'; 
      $name = 'プレイヤー';
   } else $name = $_POST['playerName'];
   if(!isset($_POST['playerHP'])){
      echo '<p> playerHP受け取れませんでした </p>'; 
      $playerHP = 10;
   } else $playerHP = $_POST['playerHP'];

   if(!isset($_POST['enemyHP'])){
      echo '<p> enemyHP受け取れませんでした </p>';
      $enemyHP = 10;
   } else $enemyHP = $_POST['enemyHP'];
   if(!isset($_POST['element_id'])){
      echo '<p> element受け取れませんでした </p>';
      $element = 1;
   } else $element = $_POST['element_id'];

   if(!isset($_POST['enemyLv'])){
      echo '<p> enemyLv受け取れませんでした </p>';
      $enemyLv = 3;
   } else $enemyLv = $_POST['enemyLv'];
   if(!isset($_POST['enemyImg'])){
      $enemyImg = '1';
   } else $enemyImg = $_POST['enemyImg'];

   // -------------プレイヤーのパラメータ情報------------
   if(!isset($_POST['AtkF'])){ //火属性攻撃力
      $AtkF = 5;
   } else $AtkF = $_POST['AtkF'];
   if(!isset($_POST['AtkG'])){ //草属性攻撃力
      $AtkG = 5;
   } else $AtkG = $_POST['AtkG'];
   if(!isset($_POST['AtkW'])){ //水属性攻撃力
      $AtkW = 5;
   } else $AtkW = $_POST['AtkW'];

   $result='有利';
   $playerAtk = 1;
   // if($element==1) $playerAtk=$AtkF;
   // elseif($element==2) $playerAtk=$AtkG;
   // else $playerAtk=$AtkW;
   $playerAtk = $enemyLv+4;
   $enemyAtk = 1;
   $enemyAtk = $enemyLv*2;

   // #-----------属性じゃんけん処理----------
   $enemyElm = rand(1, 3);
   if($element==$enemyElm) $result='互角';
   elseif($element==1){
      if($enemyElm==2) $result='有利';
      else $result='不利';
   }
   elseif($element==2){
      if($enemyElm==3) $result="有利";
      else $result="不利";
   }
   else{
      if($enemyElm==1) $result="有利";
      else $result="不利";
   }


   // #---------------攻撃力の処理--------------
   if($result=="有利") $playerAtk *= 2;
   elseif($result=="不利") $enemyAtk *= 2;
   
   // 攻撃力の乱数
   $min = 1;
   $max = 1.3;
   $enemyAtk = intval(rand($min, $max) * $enemyAtk);
   $playerAtk = intval(rand($min, $max) * $playerAtk);

   $prevEnemyHP = $enemyHP;
   $prevPlayerHP = $playerHP;


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

   //各属性の効果
   if($element==1) {
      $playerAtk *= fireElement($AtkF);
      $playerAtk = number_format($playerAtk, 0);
      intval($playerAtk);
   }
   elseif($element==2) {
      //回復処理
      $playerHP += grassElement($AtkG); 
   }
   else {
      if(rand(1,100) <= waterElement($AtkW)){
         $playerAtk = 9999;
      }
   }

   $enemyHP -= $playerAtk;
   if($enemyHP <= 0) {
      $enemyAtk = 0;
      $enemyHP = 0;
   }
   $playerHP -= $enemyAtk;

   if($playerHP <= 0) {
      $playerHP = 0;
   }

   //属性の値を文字列に変換する関数
   function elementName($x){
      if($x==1) return "火属性";
      elseif($x==2) return"草属性";
      else return "水属性";
   } 
   //属性の値を文字列(英語)に変換する関数
   function elementImage($x){
      if($x==1) return "fire";
      elseif($x==2) return"grass";
      else return "water";
   }
?>

<!-- プレイヤーと敵キャラクターの表示 -->
<div class="field">
   <div class="characterBox">
      <img src="./imgs/yuusya_game.png" alt="Player Image" style="height: 60%;" id="playerImg">
      <p class="characterStatus"> <font color="green"><?php echo $name; ?></font><br>
      <font color="green" size=4>HP:<?php echo $prevPlayerHP; ?> → <?php echo $playerHP; ?></font><br>
      <font color="green" size=4>Atk:<?php echo $playerAtk; ?></font></p>
   </div>
   <img src="./imgs/text_versus_vs.png" alt="vs Image" style="height: 30%;" class="zIndex">
   <div class="characterBox">
      <img src="./imgs/enemy/<?php echo $enemyImg; ?>.png" alt="Monster Image" style="height: 60%;" id="enemyImg">
      <p class="characterStatus"> <font color="red">敵モンスター</font><br>
      <font color="red" size=4>HP:<?php echo $prevEnemyHP; ?> → <?php echo $enemyHP; ?></font><br>
      <font color="red" size=4>Lv:<?php echo $enemyLv; ?></font>
      </p>
   </div>
   <div class="absolute">
      <img src="./imgs/<?php echo elementImage($element)?>.png" alt="Enemy Element Image" >
      <img src="./imgs/<?php echo elementImage($enemyElm)?>.png" alt="Enemy Element Image" >
   </div>
</div>

<!-- バトルログの表示 -->
<div class="battleLog">
   <p class="logText" id="battleL0">プレイヤーの属性は<font color="red"><?php echo elementName($element); ?></font>、相手の属性は<font color="red"><?php echo elementName($enemyElm); ?></font>だ！</p>
   <p class="hidden logText" id="battleL1">相性は<font color="red"><?php echo $result; ?></font>だ！</p>
   <p class="hidden logText" id="battleL2">プレイヤーの攻撃：<font color="red"><?php echo $playerAtk; ?></font>ダメージ！</p>
   <p class="hidden logText" id="battleL3">敵の攻撃：<font color="red"><?php echo $enemyAtk; ?></font>ダメージ！</p>
</div>

<!-- 値を受け渡す処理 -->
<form action="changeScene.php" method="post"> 

    <div class="btn-container">
      <input type="submit" class="classBtn disabledBtn" id="nextBtn" name="button1" value="次に進む" disabled/>
   </div>

   <!-- -----------------隠し値の受け渡し処理--------------- -->
   <input type="hidden" value="<?php echo $name ?>" name="playerName"/>
   <input type="hidden" value="<?php echo $playerHP ?>" name="playerHP" />
   <input type="hidden" value="<?php echo $AtkF ?>" name="AtkF" />
   <input type="hidden" value="<?php echo $AtkG ?>" name="AtkG" />
   <input type="hidden" value="<?php echo $AtkW ?>" name="AtkW" />
   
   <input type="hidden" value="<?php echo $enemyHP ?>" name="enemyHP" />
   <input type="hidden" value="<?php echo $enemyLv ?>" name="enemyLv" />
   <input type="hidden" value="<?php echo $enemyImg ?>" name="enemyImg" />
</form> 

<script>
   const btns = document.querySelectorAll('.hi');
   const num = 0;
   const bLog1 = document.getElementById('battleL1');
   const bLog2 = document.getElementById('battleL2');
   const bLog3 = document.getElementById('battleL3');
   const playerImg = document.getElementById('playerImg');
   const enemyImg = document.getElementById('enemyImg');

   function showLogs()
      {
         setTimeout(() => {
           bLog1.classList.remove('hidden');

         } , 2000)
         setTimeout(() => {
           bLog2.classList.remove('hidden');
            enemyImg.classList.add('hit');
            hitAnimation();
         } , 3000)
         setTimeout(() => { 
            enemyImg.classList.remove('hit'); 
            stopHitAnimation();
         } , 3400)
         setTimeout(() => {
           bLog3.classList.remove('hidden');
            playerImg.classList.add('hit');
            hitAnimation();
         } , 4000)
         setTimeout(() => { 
            playerImg.classList.remove('hit'); 
            stopHitAnimation();
         } , 4400)
         setTimeout(() => { 
            document.getElementById('nextBtn').disabled = null;
            document.getElementById('nextBtn').classList.remove('disabledBtn');
            document.getElementById('nextBtn').classList.add('enableBtn');
         } , 5000)
      }

   let aevent;
   function hitAnimation(){
         aevent = document.getElementsByClassName('hit')[0].animate(
         [
            {
               offset: 0.00,
               transform: 'translate(0, 0)'
            },
            {
               offset: 0.05,
               transform: 'translate(-10%, 0)'
            },
            {
               offset: 0.10,
               transform: 'translate(10%, 0)'
            },
            {
               offset: 0.15,
               transform: 'translate(-10%, 0)'
            },
            {
               offset: 0.20,
               transform: 'translate(10%, 0)'
            },
            {
               offset: 0.25,
               transform: 'translate(-10%, 0)'
            },
            {
               offset: 0.30,
               transform: 'translate(0, 0)'
            },
            {
               offset: 1.00,
               transform: 'translate(0, 0)'
            }
         ],
         {
               duration: 1000,
               iterations: Infinity,
               direction: 'alternate'
         }
      );  
   }
   function stopHitAnimation(){
      aevent.pause();
   }
</script>

<?php echo "<script>showLogs();</script>"; ?>
</body>
</html>