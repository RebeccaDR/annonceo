<?php

  require './model/index.php';
  require './templates/index.php';


  $categories = getCategories();

  if (isset($_REQUEST['action'])) {
    $errors = checkAnnonceForm($_REQUEST, $_REQUEST['action']);

    if ($_REQUEST['action'] == 'update' && count($errors) == 0) {
      updatePhoto($_REQUEST['photo_id'], $_REQUEST);
      updateAnnonce($_REQUEST['id_annonce'], $_REQUEST);
      // header('Location: annonces.php?update_success=true');
    }
    if ($_REQUEST['action'] == 'create' && count($errors) == 0) {
      createAnnonce($_REQUEST);
      header('Location: annonces.php?create_success=true');
    }
    if ($_REQUEST['action'] == 'delete') {
      deleteAnnonce($_REQUEST['id_annonce']);
      header('Location: annonces.php?delete_success=true');
    }

    $annonce = $_REQUEST;
    $auteur = getMembre($_REQUEST['membre_id']);
    $photo = getPhoto($_REQUEST['photo_id']);
  } else {
    $errors = [];

    if (isset($_REQUEST['id_annonce']) && $_REQUEST['id_annonce'] != '') {
      $annonce = getAnnonce($_REQUEST['id_annonce']);
      $auteur = getMembre($annonce['membre_id']);
      $photo = getPhoto($annonce['photo_id']);
    } else {
      $annonce = [];
      $auteur = [];
      $photo = ['photo1' => '', 'photo2' => '', 'photo3' => '', 'photo4' => '', 'photo5' => ''];
    }
  }

  include './templates/top.php';

  viewFormAnnonce($annonce, $categories, $auteur, $photo, $errors);

  include './templates/bottom.php'


 ?>
