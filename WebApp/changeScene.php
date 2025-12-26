<?php
    session_start();

    if(!isset($_POST['enemyHP'])){
        $enemyHP = rand(5, 10);
    } else $enemyHP = $_POST['enemyHP'];

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
    if(!isset($_POST['enemyImg'])){
      $enemyImg = '1';
   } else $enemyImg = $_POST['enemyImg'];

    $_SESSION['enemyHP'] = $enemyHP;
    $_SESSION['playerHP'] = $playerHP;
    $_SESSION['enemyLv'] = $enemyLv;
    $_SESSION['AtkF'] = $AtkF;
    $_SESSION['AtkG'] = $AtkG;
    $_SESSION['AtkW'] = $AtkW;
    $_SESSION['playerName'] = $name;
    $_SESSION['enemyImg'] = $enemyImg;
    
    if($enemyHP>=1 && $playerHP>=1){
        header('Location: action.php');
        exit;
    } elseif($enemyHP<=0){
        $enemyImg = 0;
        header('Location: battleResult.php');
        exit;
    } else{
        header('Location: gameResult.php');
        exit;
    }
?>