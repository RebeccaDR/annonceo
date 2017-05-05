<?php

  include ('./util/init.php'); // récupère fichier de connexion : $options et $pdo et le fichier qui regroupe tous les templates

  redirectUnauthorizedUsers('admin_only');

  if (isset($_REQUEST['action'])) { // Si on a récupéré une "action" au click depuis categories.php (input hidden)
    $errors = checkCategorieForm($_REQUEST, $_REQUEST['action']); // on check d'abord s'il y a des erreurs dans le formulaire en passant la fonction checkCategorieForm dans la variable $errors. On pourra réutiliser $errors comme second paramètre de la fonction qui affiche le formulaire (viewFormCategorie).

    if ($_REQUEST['action'] == 'update' && count($errors) == 0) { // si on est dans un cas d'update ET s'il n'y a pas d'erreur dans le formulaire
      updateCategorie($_REQUEST['id_categorie'], $_REQUEST); // on utilise la fonction updateCategorie un lui passant l'id de la catégorie qu'on veut changer, et les informations modifiées.
      header('Location: categories.php?update_success=true'); // Le lien nous renvoie vers la liste des catégories avec un "update_success=true" pour pouvoir afficher un message de confirmation.
    }
    if ($_REQUEST['action'] == 'create' && count($errors) == 0) {
      createCategorie($_REQUEST);
      header('Location: categories.php?create_success=true');
    }
    if ($_REQUEST['action'] == 'delete') {
      deleteCategorie($_REQUEST['id_categorie']);
      header('Location: categories.php?delete_success=true');
    }

    $categorie = $_REQUEST; // $categorie va prendre les valeurs récupérées lors du chargement de la page (vide dans le cas d'une création, un tableau de valeurs dans le cas d'une update)
  } else {
    $errors = []; // Si on arrive sur la page et qu'on a pas encore rempli ou modifié les champs et cliqué sur le bouton de création/update, on n'entre pas dans le "if". Ici on entre dans le else qui précise que le tableau d'erreur est vide tant qu'on a pas envoyé le formulaire (il n'y a pas encore d'erreur à checker puisqu'on a pas encore envoyé le formulaire).

    if (isset($_REQUEST['id_categorie']) && $_REQUEST['id_categorie'] != '') {
      $categorie = getCategorie($_REQUEST['id_categorie']); // idem toujours dans le cas où on vient d'arriver dans la page et on n'a pas encore envoyé le formulaire, on vérifie si on a obtenu un id_categorie en GET => si oui, on est en "update" et il faut afficher dans les champs les informations correspondantes à mettre à jour. On les obtient via la fonction getCategorie qui va récupérer les valeurs via l'id_categorie obtenu.
    } else {
      $categorie = []; // Si on n'a pas reçu d'id_categorie en arrivant sur la page, on est dans un cas "create", il faut que les champs restent vides.
    }
  }

  viewTop();

  viewFormCategorie($categorie, $errors); // On passe $errors et $categorie dans la fonction template qui va afficher le formulaire, rempli ou non.

// http://stackoverflow.com/questions/31963401/how-can-i-add-confirmation-dialog-to-a-submit-button-in-html5-form

if (isset($_REQUEST['id_categorie']) && $_REQUEST['id_categorie'] != '') {
?>
  <a
    class="btn btn-danger"
    onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer la catégorie ?');return false;"
    href="categorie.php?action=delete&amp;id_categorie=<?= $categorie['id_categorie']?>">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
  </a>
<?php
}

  viewBottom();

 ?>
