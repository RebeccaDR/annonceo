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
      <td>
        <a href="profil.php?id=<?=$commentaire['id_membre']?>"><?= $commentaire['pseudo']?></a>
      </td>
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
  ?>
  <form method="post" action="commentaire.php">
    <input type="hidden" name="action" value="<?= $idCommentaireExists ? 'update' : 'create' ?>">
    <input type="hidden" name="id_commentaire" value="<?= $idCommentaireExists ? $commentaire['id_commentaire'] : '' ?>">
    <?php
      if(isUserAdmin() && $idCommentaireExists):
    ?>
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
    <?php
      else:
    ?>
      <input type="hidden" name="membre_id" value="<?= $commentaire['id_membre'] ?>">
      <input type="hidden" name="annonce_id" value="<?= $commentaire['id_annonce'] ?>">
    <?php
      endif;
    ?>
    <div class="form-group">
      <?php
        if(isUserAdmin() && $idCommentaireExists):
      ?>
      <label class="control-label">Commentaire</label>
      <?php
        endif;
      ?>
      <textarea class="form-control" type="text" name="commentaire" placeholder="Ecrire un commentaire"><?= isset($commentaire['commentaire']) ? $commentaire['commentaire'] : '' ?></textarea>
    </div>
    <input class="btn btn-primary btn-creation" type="submit" value="<?= $idCommentaireExists ? 'Mettre à jour' : 'Envoyer' ?>"/>
  </form>
  <?php
}

function viewCommentaires ($commentaires) {
  ?>
  <div class="row">
  <?php
  foreach ($commentaires as $commentaire):
  ?>
  <div class="col-md-12">
    <div class="panel panel-default" style="padding: 10px; margin-bottom: 0;">
      <p>
        Commentaire envoyé par <a href="profil.php?id=<?=$commentaire['id_membre']?>"><?= $commentaire['pseudo']?></a> le <b><?= $commentaire['date_enregistrement']?></b>
      </p>
      <p><?= $commentaire['commentaire']?></p>
    </div>
  </div>
  <?php
  endforeach;
  ?>
  </div>
  <?php
}

 ?>
