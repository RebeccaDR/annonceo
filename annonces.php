<?php

  require './model/index.php';
  require './templates/index.php';

  include './templates/top.php';

  $annonces = getAnnonces();

  // echo "<pre>";
  // print_r($annonces);
  // echo "</pre>";

  viewListeAnnonces($annonces);



  include './templates/bottom.php';


 ?>
