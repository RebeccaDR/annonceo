<?php


  // Require Model & template functions
  require './model/index.php'; // calls $pdo + $options
  require './templates/index.php';

  include './templates/top.php';

  // Message d'alerte, création ou update enregistrée
  if (isset($_REQUEST['create_success'])) {
    echo '<div class="alert alert-success" role="alert">Utilisateur créé avec succès</div>';
  }
  if (isset($_REQUEST['update_success'])) {
    echo '<div class="alert alert-success" role="alert">Utilisateur modifié avec succès</div>';
  }

  // Get membres is
  $membres = getMembres();  // cf model/membres.php
  viewListeMembres($membres);  // cf templates/membres.php

  ?>
  <a class="btn btn-default" href="./membre.php">Créer un nouveau membre</a>
  <?php

  include './templates/bottom.php';
