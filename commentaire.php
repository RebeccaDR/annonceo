<?php

require './model/index.php';
require './templates/index.php';

if (isset($_REQUEST['action'])) {

  if ($_REQUEST['action'] == 'update') {
    updateCommentaire($_REQUEST['id_commentaire'], $_REQUEST);
    header('Location: commentaires.php?update_success=true');
  }
  if ($_REQUEST['action'] == 'create') {
    createCommentaire($_REQUEST);
    header('Location: membres.php?create_success=true');
  }
  if ($_REQUEST['action'] == 'delete') {
    deleteCommentaire($_REQUEST['id_commentaire']);
    header('Location: commentaires.php?delete_success=true');
  }

  $membre = $_REQUEST;
} else {

  // $_REQUEST works for POST and GET
  if (isset($_REQUEST['id_commentaire']) && $_REQUEST['id_commentaire'] != '') {
    $commentaire = getCommentaire($_REQUEST['id_commentaire']);
  } else {
    $commentaire = [];
  }
}

include './templates/top.php';

viewFormCommentaire($commentaire);


if (isset($_REQUEST['id_commentaire']) && $_REQUEST['id_commentaire'] != '') {
?>
  <a
    class="btn btn-danger"
    onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer le commentaire ?');return false;"
    href="commentaire.php?action=delete&amp;id_commentaire=<?= $membre['id_commentaire']?>">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
  </a>
<?php
}

include './templates/bottom.php'

 ?>
