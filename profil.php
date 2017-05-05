<?php

  include ('./util/init.php');

  viewTop();

  $membre = getMembre($_REQUEST['id']);

  if ($currentUser['id_membre'] == $_REQUEST['id']) {
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

  if ($currentUser['id_membre'] == $_REQUEST['id']) {
    ?>
    <a class="btn btn-default" href="./membre.php?id_membre=<?= $currentUser['id_membre'] ?>">Modifier mon profil</a>
    <?php
  } else {
    $note = getNoteByUsers($currentUser['id_membre'], $_REQUEST['id']);

    if (empty($note)) {
      $note = [
        'membre_id1' => $currentUser['id_membre'],
        'membre_id2' => $_REQUEST['id'],
        'note' => 0
      ];
    }

    viewFormNote($note);
  }

  viewBottom();


 ?>
