<?php

require './model/index.php';
require './templates/index.php';

if (isset($_REQUEST['action'])) {

  if ($_REQUEST['action'] == 'update') {
    updateNote($_REQUEST['id_note'], $_REQUEST);
    header('Location: notes.php?update_success=true');
  }
  if ($_REQUEST['action'] == 'create') {
    createNote($_REQUEST);
    header('Location: notes.php?create_success=true');
  }
  if ($_REQUEST['action'] == 'delete') {
    deleteNote($_REQUEST['id_note']);
    header('Location: notes.php?delete_success=true');
  }

  $membre = $_REQUEST;
} else {

  // $_REQUEST works for POST and GET
  if (isset($_REQUEST['id_note']) && $_REQUEST['id_note'] != '') {
    $note = getNote($_REQUEST['id_note']);
  } else {
    $note = [];
  }
}

include './templates/top.php';

viewFormNote($note);


if (isset($_REQUEST['id_note']) && $_REQUEST['id_note'] != '') {
?>
  <a
    class="btn btn-danger"
    onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer la note ?');return false;"
    href="note.php?action=delete&amp;id_note=<?= $membre['id_note']?>">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
  </a>
<?php
}

include './templates/bottom.php'

 ?>
