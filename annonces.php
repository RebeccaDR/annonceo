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
    $categorie = isset($_REQUEST['categorie']) ? $_REQUEST['categorie'] : '';
    $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
    $annonces = getAnnonces($search, $categorie);
  }

  echo '<h2>' . $titre . '</h2>';

  if (isset($_REQUEST['search'])) {
    echo '<p>Recherche d\'annonces pour "' . $_REQUEST['search'] . '"';
  }

  if (count($annonces) != 0) {
    viewListeAnnonces($annonces);
  } else {
    echo '<div class="alert alert-danger" role="alert">Pas d\'annonce trouvée pour cette recherche</div>';
  }

  if (isUserConnected()) {
    ?>
    <a class="btn btn-default btn-creation" href="./annonce.php">Créer une nouvelle annonce</a>
    <?php
  }

  viewBottom();


 ?>
