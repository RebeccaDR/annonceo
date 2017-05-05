<?php

  include ('./util/init.php');

  redirectUnauthorizedUsers('admin_only');

  viewTop();

  // Message d'alerte, création ou update enregistrée
  if (isset($_REQUEST['create_success'])) { // On vérifie si on a bien récupéré "create_success" dans le lien
    echo '<div class="alert alert-success" role="alert">Catégorie créée avec succès</div>';
  }
  if (isset($_REQUEST['update_success'])) {
    echo '<div class="alert alert-success" role="alert">Catégorie modifiée avec succès</div>';
  }
  if (isset($_REQUEST['delete_success'])) {
    echo '<div class="alert alert-success" role="alert">Catégorie supprimée avec succès</div>';
  }


  $categories = getCategories(); // on définit la variable $categories en utilisant la fonction getCategories() qui va récupérer l'ensemble des catégories dans la bdd
  viewListeCategories($categories); // on passe $categories (qui représente donc toutes les valeur du tableau "categorie" dans la bdd) dans la fonction viewListeCategories, qui va se charger d'afficher le tableau en html et y plasser les valeurs de $categories.

  ?>
  <a class="btn btn-default btn-creation" href="./categorie.php">Créer une nouvelle catégorie</a>
  <?php


  viewBottom();

 ?>
