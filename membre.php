<?php

  // Require Model & template functions
  require './model/index.php';  // calls $pdo + $options
  require './templates/index.php';

  include './templates/top.php';

  echo '<pre>';
  print_r($_REQUEST);
  echo '</pre>';
  // if action parameter was passed, the page is a form submission
  if (isset($_REQUEST['action'])) {
    $errors = checkMembreForm($_REQUEST, $_REQUEST['action']);

    if ($_REQUEST['action'] == 'update' && count($errors) == 0) {
      updateMembre($_REQUEST['id_membre'], $_REQUEST);
      // header('Location: membres.php?update_success=true');
    }
    if ($_REQUEST['action'] == 'create' && count($errors) == 0) {
      createMembre($_REQUEST);
      // header('Location: membres.php?create_success=true');
    }
    if ($_REQUEST['action'] == 'delete') {
      deleteMembre($_REQUEST['id_membre']);
      // header('Location: membres.php?delete_success=true');
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

  // Print raw return of getMembres function
  viewMembreForm($membre, $errors);

  include './templates/bottom.php';
