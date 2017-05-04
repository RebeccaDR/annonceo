<?php

function viewListeNotes ($notes) {
  ?>
  <table class="table table-striped table-bordered">
    <tr>
      <th>id</th>
      <th>Donné par l'utilisateur</th>
      <th>à l'utilisateur</th>
      <th>note</th>
      <th>avis</th>
      <th>date_enregistrement</th>
      <th>actions</th>
    </tr>

    <?php
			foreach ($notes as $note):
		?>
    <tr>
			<td><?= $note['id_note']?></td>
      <td><?= $note['membre_id1'] . ' - ' . $note['pseudo1']?></td>
      <td><?= $note['membre_id2'] . ' - ' . $note['pseudo2']?></td>
      <td><?= viewStars($note['note'])?></td>
      <td><?= $note['avis']?></td>
      <td><?= $note['date_enregistrement']?></td>
      <td>
        <a href="note.php?id_note=<?= $note['id_note']?>">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
      </td>
    </tr>
    <?php
  endforeach;
    ?>
  </table>
  <?php
}

function viewStars ($note) {
  for ($i = 1; $i <= 5; $i += 1) {
    if ($i <= $note) {
      ?>
        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
      <?php
    } else {
      ?>
        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
      <?php
    }
  }
}


function viewFormNote ($note) {
  $idNoteExists = isset($note['id_note']) && $note['id_note'] != '';

  if ($idNoteExists) {
    $formTitle = 'Modifier une note';
  } else {
    $formTitle = 'Ajouter une note';
  }

  ?>

  <h2><?= $formTitle ?></h2>
  <form method="post" action="note.php">
    <input type="hidden" name="action" value="<?= $idNoteExists ? 'update' : 'create' ?>">
    <input type="hidden" name="id_note" value="<?= $idNoteExists ? $note['id_note'] : '' ?>">
    <?php
    if (isUserAdmin()) {
     ?>
    <div class="form-group">
      <label class="control-label">Donné par l'utilisateur</label>
      <input type="hidden" name="membre_id1" value="<?= $note['membre_id1'] ?>">
      <input class="form-control" type="text" disabled="disabled" value="<?= $note['pseudo1'] ?>">
    </div>
    <div class="form-group">
      <label class="control-label">à l'utilisateur</label>
      <input type="hidden" name="membre_id2" value="<?= $note['membre_id2'] ?>">
      <input class="form-control" type="text" disabled="disabled" value="<?= $note['pseudo2'] ?>">
    </div>
    <?php
    } else {
    ?>
    <input type="hidden" name="membre_id1" value="<?= $note['membre_id1'] ?>">
    <input type="hidden" name="membre_id2" value="<?= $note['membre_id2'] ?>">
    <?php
    }
     ?>
    <div class="form-group">
      <label class="control-label">Note</label>
      <div class="rating">
          <input id="star5" name="note" type="radio" value="5" class="radio-btn hide"
          <?= $note['note'] == 5 ? 'checked="checked"' : '' ?> />
          <label for="star5">☆</label>
          <input id="star4" name="note" type="radio" value="4" class="radio-btn hide"
          <?= $note['note'] == 4 ? 'checked="checked"' : '' ?> />
          <label for="star4">☆</label>
          <input id="star3" name="note" type="radio" value="3" class="radio-btn hide"
          <?= $note['note'] == 3 ? 'checked="checked"' : '' ?> />
          <label for="star3">☆</label>
          <input id="star2" name="note" type="radio" value="2" class="radio-btn hide"
          <?= $note['note'] == 2 ? 'checked="checked"' : '' ?> />
          <label for="star2">☆</label>
          <input id="star1" name="note" type="radio" value="1" class="radio-btn hide"
          <?= $note['note'] == 1 ? 'checked="checked"' : '' ?> />
          <label for="star1">☆</label>
          <div class="clear"></div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Avis</label>
      <textarea class="form-control" type="text" name="avis" placeholder="Ecrire un avis"><?= isset($note['avis']) ? $note['avis'] : '' ?></textarea>
    </div>
    <input class="btn btn-primary" type="submit" value="<?= $idNoteExists ? 'Mettre à jour' : 'Envoyer ma note' ?>"/>
  </form>
  <?php
}

 ?>
