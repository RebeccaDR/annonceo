<?php

include ('./util/init.php');

viewTop();

if (isset($_REQUEST['update_success'])) {
  echo '<div class="alert alert-success" role="alert">La note a bien été mise à jour.</div>';
}

if (isset($_REQUEST['id'])) {
  if ($_REQUEST['id'] == $currentUser['id_membre']) {
    $titre = 'Mes avis';
  } else {
    $membre = getMembre($_REQUEST['id']);
    $titre = 'Les avis de ' . $membre['pseudo'];
  }
  $notes = getNotesByUser($_REQUEST['id']);
} else {
  $titre = 'Notes des utilisateurs';
  $notes = getNotes();
}
?>
<h2><?=$titre?></h2>
<?php
viewListeNotes($notes);

viewBottom();

 ?>
