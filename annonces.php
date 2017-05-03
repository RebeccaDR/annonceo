<?php

  require './model/index.php';
  require './templates/index.php';

  include './templates/top.php';

  // Message d'alerte, création ou update enregistrée
  if (isset($_REQUEST['create_success'])) {
    echo '<div class="alert alert-success" role="alert">Annonce créée avec succès</div>';
  }
  if (isset($_REQUEST['update_success'])) {
    echo '<div class="alert alert-success" role="alert">Annonce modifiée avec succès</div>';
  }
  if (isset($_REQUEST['delete_success'])) {
    echo '<div class="alert alert-success" role="alert">Annonce supprimée avec succès</div>';
  }

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
