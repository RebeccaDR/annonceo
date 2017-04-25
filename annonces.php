<?php

  require './model/index.php';
  require './templates/index.php';

  include './templates/top.php';

  $annonces = getAnnonces();

  // echo "<pre>";
  // print_r($annonces);
  // echo "</pre>";

  viewListeAnnonces($annonces);

  ?>
  <a class="btn btn-default" href="./annonce.php">Créer une nouvelle annonce</a>
  <?php

  include './templates/bottom.php';


 ?>
