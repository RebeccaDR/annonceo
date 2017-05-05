<?php

  include ('./util/init.php');


  if (!isset($_REQUEST['id'])) {
    redirectUnauthorizedUsers('logged_user_only');
    $id_membre = $currentUser['id_membre'];
  } else {
    $id_membre = $_REQUEST['id'];
  }

  viewTop();

  $membre = getMembre($id_membre);

  if (isIdCurrentUser($id_membre)) {
    $titre = 'Mon profil';
  } else {

    $titre = 'Profil de ' . $membre['pseudo'];
  }


  if (empty($membre)) {
    echo '<h2>Utilisateur inconnu</h2>';
    viewBottom();
    die();
  }
  ?>
  <h2><?= $titre ?></h2>

  <?php

  if (isset($_REQUEST['update_success'])) {
    echo '<div class="alert alert-success" role="alert">Profil modifié avec succès</div>';
  }
  if (isset($_REQUEST['note_success'])) {
    echo '<div class="alert alert-success" role="alert">Note envoyée avec succès</div>';
  }


  viewMembreProfil($membre);

  if (isIdCurrentUser($id_membre)) {
    ?>
    <a class="btn btn-default" href="./membre.php?id_membre=<?= $currentUser['id_membre'] ?>">Modifier mon profil</a>
    <?php
  } else if (isUserConnected()){
    $note = getNoteByUsers($currentUser['id_membre'], $id_membre);

    if (empty($note)) {
      $note = [
        'membre_id1' => $currentUser['id_membre'],
        'membre_id2' => $id_membre,
        'note' => 0
      ];
    }

    viewFormNote($note);
  }

  viewBottom();


 ?>
