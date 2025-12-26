<!-- 選択された属性に応じて、その属性を強化する -->
<?php
  session_start();
  // if(!isset($_POST['enemyHP'])){
  //     $enemyHP = rand(5, 10);
  // } else $enemyHP = $_POST['enemyHP'];

  if(!isset($_POST['playerHP'])){
      $playerHP = 10;
  } else $playerHP = $_POST['playerHP'];
  if(!isset($_POST['enemyLv'])){
      $enemyLv = 1;
  } else $enemyLv = $_POST['enemyLv'];
  if(!isset($_POST['AtkF'])){
      $AtkF = 5;
  } else $AtkF = $_POST['AtkF'];
  if(!isset($_POST['AtkG'])){
      $AtkG = 5;
  } else $AtkG = $_POST['AtkG'];
  if(!isset($_POST['AtkW'])){
      $AtkW = 5;
  } else $AtkW = $_POST['AtkW'];

  if(!isset($_POST['playerName'])){
    $name = 'プレイヤー';
  } else $name = $_POST['playerName'];


  //選択された属性の値を参照して加算する
  if(!isset($_POST['element_id'])){
    $element = 1;
  } else $element = $_POST['element_id'];

  if($element==1) $AtkF+=1;
  elseif($element==2) $AtkG+=1;
  else $AtkW+=1;

  $_SESSION['enemyHP'] = $enemyHP;
  $_SESSION['playerHP'] = $playerHP;
  $_SESSION['enemyLv'] = $enemyLv;
  $_SESSION['AtkF'] = $AtkF;
  $_SESSION['AtkG'] = $AtkG;
  $_SESSION['AtkW'] = $AtkW;
  $_SESSION['playerName'] = $name;

  header('Location: action.php');
  exit;
?>