<?php

function viewSelectCategorie ($categories) {
  ?>
  <select name="id_categorie">
    <?php
			foreach ($categories as $categorie):
		?>
    <option value="<?= $categorie['id_categorie']?>" >
      <?= $categorie['titre']?>
    </option>
    <?php
  endforeach;
    ?>
  </table>
  <?php
}

function viewListeCategories ($categories) { // fonction qui affiche la liste des catégories
  ?>
  <table class="table table-striped table-bordered">
    <tr> <!-- ligne des titres -->
      <th>id categorie</th>
      <th>titre</th>
      <th>mots cles</th>
      <th>actions</th>
    </tr>

    <?php
      foreach ($categories as $categorie):
    ?>
    <tr> <!-- ligne des catégories, pour chaque catégorie ("for each") -->
      <td><?= $categorie['id_categorie']?></td>
      <td><?= $categorie['titre']?></td>
      <td><?= $categorie['motscles']?></td>
      <td>
        <a href="categorie.php?id_categorie=<?= $categorie['id_categorie']?>"> <!-- Bouton édition qui renvoie vers categorie.php en conservant l'id_categorie dans le lien (GET method) pour permettre la modification des valeurs de la catégorie. -->
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

function viewFormCategorie ($categorie, $errors) { // la fonction va "imprimer" le formulaire html dans la page. ELle n'a besoin que des informations de categories récupérées dans la page (via $_REQUEST) et de l'affichage des erreurs tel que défini dans la fonction checkCategorieForm.
  $idCategorieExists = isset($categorie['id_categorie']) && $categorie['id_categorie'] != '';

  if ($idCategorieExists) {
    $formTitle = 'Modifier une catégorie';
  } else {
    $formTitle = 'Créer une catégorie';
  }

  ?>

  <h2><?= $formTitle ?></h2>
  <form method="post" action="categorie.php">
    <input type="hidden" name="action" value="<?= $idCategorieExists ? 'update' : 'create' ?>"> <!-- if / else = si l'id_categorie est bien récupéré dans la page, on passe en mode "update" et on affiche les informations de la categorie récupérée. Sinon, on passe en mode "create" et les champs du formulaire resteront vides. -->
    <input type="hidden" name="id_categorie" value="<?= $idCategorieExists ? $categorie['id_categorie'] : '' ?>">
    <div class="form-group">
      <label class="control-label">Titre</label>
      <input class="form-control" type="text" name="titre" placeholder="Titre de la catégorie" value="<?= isset($categorie['titre']) ? $categorie['titre'] : '' ?>">
      <!-- si l'id est récupéré (donc si on est en mode update), on récupère du coup la valeur de "titre" et on l'affiche dans le champ ; sinon, on laisse le champ vide. -->
      <span class="form-error-label"><?= isset($errors['titre']) ? $errors['titre'] : '' ?></span>
    </div>
    <div class="form-group">
      <label class="control-label">Mots clés</label>
      <input class="form-control" type="text" name="motscles" placeholder="Mots clés" value="<?= isset($categorie['motscles']) ? $categorie['motscles'] : '' ?>">
      <span class="form-error-label"><?= isset($errors['motscles']) ? $errors['motscles'] : '' ?></span>
    </div>
    <input class="btn btn-primary" type="submit" value="<?= $idCategorieExists ? 'Mettre à jour' : 'Créer la catégorie' ?>"/> <!-- Si on a récupéré un id_categorie, on est dans le cas d'une update, on change donc la valeur du bouton pour la mise à jour / sinon, on est dans un cas de création de catégorie donc on adapte la valeur du bouton. -->
  </form>
  <?php
}
