<?php

  require_once('./templates/categories.php');

  function viewListeAnnonces ($annonces) {
    ?>
    <table class="table table-striped table-bordered">
      <tr> <!-- ligne des titres -->
        <?php
        if (isUserAdmin()) :
        ?>
        <th>id annonce</th>
        <?php
        endif;
        ?>
        <th>titre</th>
        <th>description courte</th>
        <th>prix</th>
        <th>adresse</th>
        <th>auteur</th>
        <th>photo(s)</th>
        <th>catégorie</th>
        <th>date</th>
        <?php
        if (isUserAdmin()) :
        ?>
        <th>actions</th>
        <?php
        endif;
        ?>
      </tr>
      <?php
        foreach ($annonces as $annonce):
      ?>
      <tr>
        <?php
         if (isUserAdmin()) :
         ?>
        <td><?= $annonce['id_annonce']?></td>
        <?php
        endif;
        ?>
        <td><a href="annonce.php?id_annonce=<?= $annonce['id_annonce']?>"><?= $annonce['titre_annonce']?></a></td>
        <td><?= $annonce['description_courte']?></td>
        <td><?= $annonce['prix']?></td>
        <td>
        <?= $annonce['adresse']?><br/>
        <?= $annonce['cp']?> - <?= $annonce['ville']?><br/>
        <?= $annonce['pays']?>
        </td>
        <td><a href="profil.php?id=<?= $annonce['membre_id'] ?>"><?= $annonce['pseudo']?></a></td>
        <td>
        <?php if (isset($annonce['photo1'])) : ?>
          <div class="thumbnail">
            <img src="uploads/<?= $annonce['photo1'] ?>">
            <a href="annonce.php?id_annonce=<?= $annonce['id_annonce']?>">Voir les autres photos</a>
          </div>
        <?php endif; ?>
        </td>
        <td><?= $annonce['titre_categorie']?></td>
        <td><?= $annonce['date_enregistrement']?></td>
        <?php
         if (isUserAdmin()) :
         ?>
        <td>
          <a href="annonce.php?id_annonce=<?= $annonce['id_annonce']?>&amp;edit=true">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </a>
        </td>
        <?php
        endif;
        ?>
      </tr>
      <?php
        endforeach;
      ?>
    </table>
    <?php
  }


  function viewFormAnnonce ($annonce, $categories, $membre, $photo, $errors) {
    $idAnnonceExists = isset($annonce['id_annonce']) && $annonce['id_annonce'] != '';

    if ($idAnnonceExists) {
      $formTitle = 'Modifier une annonce';
    } else {
      $formTitle = 'Créer une annonce';
    }

    ?>

    <h2><?= $formTitle ?></h2>
    <form method="post" action="annonce.php" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <input type="hidden" name="action" value="<?= $idAnnonceExists ? 'update' : 'create' ?>">
          <input type="hidden" name="id_annonce" value="<?= $idAnnonceExists ? $annonce['id_annonce'] : '' ?>">
          <div class="form-group">
            <label class="control-label">Titre</label>
            <input class="form-control" type="text" name="titre" placeholder="Titre de l'annonce" value="<?= isset($annonce['titre_annonce']) ? $annonce['titre_annonce'] : '' ?>">
            <span class="form-error-label"><?= isset($errors['titre']) ? $errors['titre'] : '' ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Categorie</label>
            <?php
              viewSelectCategorie($categories);
             ?>
          </div>
          <div class="form-group">
            <label class="control-label">Prix</label>
            <div class="input-group">
              <input class="form-control" type="number" name="prix" placeholder="Prix" value="<?= isset($annonce['prix']) ? $annonce['prix'] : '' ?>">
              <span class="input-group-addon" id="basic-addon2">€</span>
            </div>
            <span class="form-error-label"><?= isset($errors['prix']) ? $errors['prix'] : '' ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Description courte</label>
            <input class="form-control" type="text" name="description_courte" placeholder="Description courte" value="<?= isset($annonce['description_courte']) ? $annonce['description_courte'] : '' ?>">
            <span class="form-error-label"><?= isset($errors['description_courte']) ? $errors['description_courte'] : '' ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Description longue</label>
            <textarea class="form-control" name="description_longue" placeholder="Description longue"><?= isset($annonce['description_longue']) ? $annonce['description_longue'] : '' ?></textarea>
            <span class="form-error-label"><?= isset($errors['description_longue']) ? $errors['description_longue'] : '' ?></span>
          </div>
          <h3>Adresse</h3>
          <div class="form-group">
            <label class="control-label">Rue</label>
            <input class="form-control" type="text" name="adresse" placeholder="Numéro et nom de rue" value="<?= isset($annonce['adresse']) ? $annonce['adresse'] : '' ?>">
            <span class="form-error-label"><?= isset($errors['adresse']) ? $errors['adresse'] : '' ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Code Postal</label>
            <input class="form-control" type="text" name="cp" placeholder="Code Postal" value="<?= isset($annonce['cp']) ? $annonce['cp'] : '' ?>">
            <span class="form-error-label"><?= isset($errors['cp']) ? $errors['cp'] : '' ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Ville</label>
            <input class="form-control" type="text" name="ville" placeholder="Ville" value="<?= isset($annonce['ville']) ? $annonce['ville'] : '' ?>">
            <span class="form-error-label"><?= isset($errors['ville']) ? $errors['ville'] : '' ?></span>
          </div>
          <div class="form-group">
            <label class="control-label">Pays</label>
            <input class="form-control" type="text" name="pays" placeholder="Pays" value="<?= isset($annonce['pays']) ? $annonce['pays'] : '' ?>">
            <span class="form-error-label"><?= isset($errors['pays']) ? $errors['pays'] : '' ?></span>
          </div>
        </div>
        <div class="col-md-6">
          <?= viewPhotoForm($photo, $errors); ?>
          <hr/>
          <?php
           if (isUserAdmin()) :
           ?>
           <div class="form-group">
             <label class="control-label">Auteur</label>
             <input type="hidden" name="membre_id" value="<?= $membre['id_membre'] ?>">
             <input class="form-control" type="text" disabled="disabled" value="<?= $membre['pseudo'] ?>">
           </div>
           <hr/>
          <?php
          endif;
          ?>
        </div>
      </div>
      <input class="btn btn-primary" type="submit" value="<?= $idAnnonceExists ? 'Mettre à jour' : 'Créer l\'annonce' ?>"/>
    </form>
    <?php
  }

  function viewPhotoForm ($photos, $errors) {
    $idPhotoExists = isset($photos['id_photo']) && $photos['id_photo'] != '';
    ?>
      <div class="photo-form">
        <input type="hidden" name="photo_id" value="<?= $idPhotoExists ? $photos['id_photo'] : '' ?>">
        <?php
          foreach ($photos as $key => $photo):
          if ($key != 'id_photo'):
            if ($photo != ''):
            ?>
            <div class="thumbnail form-thumbnail">
              <input type="hidden" name="<?= $key ?>" value="<?= $photo ?>">
              <img src="uploads/<?= $photo ?>">
            </div>
            <?php
            else:
            ?>
            <!-- upload button https://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3 -->
            <div class="btn-file thumbnail form-thumbnail">
              <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
              <?= $key ?> <input type="file" name="<?= $key ?>">
              <span class="form-error-label"><?= isset($errors[$key]) ? $errors[$key] : '' ?></span>
            </div>
            <?php
            endif;
          endif;
          endforeach;
        ?>
      </div>
    <?php
  }

 function viewAnnonce ($annonce, $categories, $membre, $photo) {
   ?>
   <div class="row">
     <div class="col-md-9">
       <h2><?= $annonce['titre_annonce'] ?></h2>
       <?php
       if (isUserAdmin()) {
       ?>
       <a class="btn btn-primary" href="annonce.php?id_annonce=<?= $annonce['id_annonce']?>&amp;edit=true">
         Modifier cette annonce
       </a>
       <?php
        }
       ?>
       <p><?= $annonce['titre_categorie'] ?></p>
       <div class="images">
         <img src="<?= $photo['photo1'] ?>" />
       </div>
     </div>
     <div class="col-md-3">
       <p>Publié par <?= $membre['pseudo'] ?></p>
       <p><?= $annonce['date_enregistrement'] ?></p>
     </div>
   <?php
 }
