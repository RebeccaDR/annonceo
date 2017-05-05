<?php

  include ('./util/init.php');

  viewTop();

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

  if (isset($_REQUEST['id'])) {
    if ($_REQUEST['id'] == $currentUser['id_membre']) {
      $titre = 'Mes annonces';
    } else {
      $membre = getMembre($_REQUEST['id']);
      $titre = 'Les annonces de ' . $membre['pseudo'];
    }
    $annonces = getAnnoncesByUser($_REQUEST['id']);
  } else {
    $titre = 'Annonces';
    $annonces = getAnnonces();
  }


  viewListeAnnonces($annonces);

  ?>

  <a class="btn btn-default btn-creation" href="./annonce.php">Créer une nouvelle annonce</a>
  <?php

  viewBottom();


 ?>
