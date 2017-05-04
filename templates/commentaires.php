<?php

function viewListeCommentaires ($commentaires) {
  ?>
  <table class="table table-striped table-bordered">
    <tr> <!-- ligne des titres -->
      <th>id commentaire</th>
      <th>membre</th>
      <th>annonce</th>
      <th>commentaire</th>
      <th>date d'enregistrement</th>
      <th>actions</th>
    </tr>
    <?php
      foreach ($commentaires as $commentaire):
    ?>
    <tr>
      <td><?= $commentaire['id_commentaire']?></td>
      <td><?= $commentaire['id_membre'] . ' - ' . $commentaire['pseudo']?></td>
      <td><?= $commentaire['id_annonce'] . ' - ' . $commentaire['titre']?></td>
      <td><?= $commentaire['commentaire']?></td>
      <td><?= $commentaire['date_enregistrement']?></td>
      <td>
        <a href="commentaire.php?id_commentaire=<?= $commentaire['id_commentaire']?>">
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


function viewFormCommentaire ($commentaire) {
  $idCommentaireExists = isset($commentaire['id_commentaire']) && $commentaire['id_commentaire'] != '';

  if ($idCommentaireExists) {
    $formTitle = 'Modifier un commentaire';
  } else {
    $formTitle = 'Ajouter un commentaire';
  }

  ?>

  <h2><?= $formTitle ?></h2>
  <form method="post" action="commentaire.php">
    <input type="hidden" name="action" value="<?= $idCommentaireExists ? 'update' : 'create' ?>">
    <input type="hidden" name="id_commentaire" value="<?= $idCommentaireExists ? $commentaire['id_commentaire'] : '' ?>">
    <div class="form-group">
      <label class="control-label">Auteur</label>
      <input type="hidden" name="membre_id" value="<?= $commentaire['id_membre'] ?>">
      <input class="form-control" type="text" disabled="disabled" value="<?= $commentaire['pseudo'] ?>">
    </div>
    <div class="form-group">
      <label class="control-label">Annonce</label>
      <input type="hidden" name="annonce_id" value="<?= $commentaire['id_annonce'] ?>">
      <input class="form-control" type="text" disabled="disabled" value="<?= $commentaire['annonce_id'] . ' - ' . $commentaire['titre'] ?>">
    </div>
    <div class="form-group">
      <label class="control-label">Commentaire</label>
      <textarea class="form-control" type="text" name="commentaire" placeholder="Ecrire un commentaire"><?= isset($commentaire['commentaire']) ? $commentaire['commentaire'] : '' ?></textarea>
    </div>
    <input class="btn btn-primary" type="submit" value="<?= $idCommentaireExists ? 'Mettre à jour' : 'Envoyer mon commentaire' ?>"/>
  </form>
  <?php
}

 ?>
