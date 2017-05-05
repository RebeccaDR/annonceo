<?php

  include ('./util/init.php');

  viewTop();

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
  <a class="btn btn-default btn-creation" href="./membre.php">Créer un nouveau membre</a>
  <?php

  viewBottom();
