<?php

include ('./util/init.php');

redirectUnauthorizedUsers('admin_only');

viewTop();

// Message d'alerte, création ou update enregistrée
if (isset($_REQUEST['create_success'])) {
  echo '<div class="alert alert-success" role="alert">Commentaire créé avec succès</div>';
}
if (isset($_REQUEST['update_success'])) {
  echo '<div class="alert alert-success" role="alert">Commentaire modifié avec succès</div>';
}
if (isset($_REQUEST['delete_success'])) {
  echo '<div class="alert alert-success" role="alert">Commentaire supprimé avec succès</div>';
}

$commentaires = getCommentaires();


viewListeCommentaires($commentaires);


viewBottom();

 ?>
