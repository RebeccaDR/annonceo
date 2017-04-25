<?php

session_start();

include './model/index.php';

$user = getMembreByLogin($_REQUEST['pseudo'], $_REQUEST['mdp']);

if (!empty($user)) {
  setCurrentUser($user);
  echo '<pre>';
  print_r($user);
  print_r($_SESSION);
  echo '</pre>';
  // header('Location: index.php');
}

 ?>
