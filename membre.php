<?php

  include ('./util/init.php');

  // if action parameter was passed, the page is a form submission
  if (isset($_REQUEST['action'])) {
    $errors = checkMembreForm($_REQUEST, $_REQUEST['action']);

    if ($_REQUEST['action'] == 'update' && count($errors) == 0) {
      updateMembre($_REQUEST['id_membre'], $_REQUEST);
      if (isUserAdmin()) {
        header('Location: membres.php?update_success=true');
      } else {
        header('Location: profil.php?update_success=true&id=' . $_REQUEST['id_membre']);
      }
    }
    if ($_REQUEST['action'] == 'create' && count($errors) == 0) {
      createMembre($_REQUEST);
      header('Location: membres.php?create_success=true');
    }
    if ($_REQUEST['action'] == 'delete') {
      deleteMembre($_REQUEST['id_membre']);
      header('Location: membres.php?delete_success=true');
    }

    $membre = $_REQUEST;
  } else {

    $errors = [];
    // $_REQUEST works for POST and GET
    if (isset($_REQUEST['id_membre']) && $_REQUEST['id_membre'] != '') {
      $membre = getMembre($_REQUEST['id_membre']);
    } else {
      $membre = [];
    }
  }

  if (isset($_REQUEST['id_membre']) && $_REQUEST['id_membre'] != '') {
    if ($currentUser['id_membre'] == $_REQUEST['id_membre']) {
      $formTitle = 'Modifier mon profil';
    } else if (isUserAdmin()) {
      $formTitle = 'Modifier un utilisateur';
    } else {
      securityRedirect('Accès refusé');
    }
  } else {
    $formTitle = 'Créer un utilisateur';
  }

  viewTop();

  ?>
  <h2><?= $formTitle ?></h2>
  <?php

  // Print raw return of getMembres function
  viewMembreForm($membre, $errors);


  if (isset($_REQUEST['id_membre']) && $_REQUEST['id_membre'] != '' && isUserAdmin()) {
  ?>
    <a
      class="btn btn-danger"
      onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer le membre ?');return false;"
      href="membre.php?action=delete&amp;id_membre=<?= $membre['id_membre']?>">
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
    </a>
  <?php
  }

  viewBottom();
