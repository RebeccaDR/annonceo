<?php

  function viewListeAnnonces ($annonces) {
    ?>
    <table class="table table-striped table-bordered">
      <tr> <!-- ligne des titres -->
        <th>id annonce</th>
        <th>titre</th>
        <th>description courte</th>
        <th>description longue</th>
        <th>prix</th>
        <th>pays</th>
        <th>ville</th>
        <th>adresse</th>
        <th>CP</th>
        <th>auteur</th>
        <th>photo(s)</th>
        <th>catégorie</th>
        <th>date</th>
        <th>actions</th>
      </tr>
      <?php
        foreach ($annonces as $annonce):
      ?>
      <tr>
        <td><?= $annonce['id_annonce']?></td>
        <td><?= $annonce['titre_annonce']?></td>
        <td><?= $annonce['description_courte']?></td>
        <td><?= $annonce['description_longue']?></td>
        <td><?= $annonce['prix']?></td>
        <td><?= $annonce['pays']?></td>
        <td><?= $annonce['ville']?></td>
        <td><?= $annonce['adresse']?></td>
        <td><?= $annonce['cp']?></td>
        <td><?= $annonce['pseudo']?></td>
        <td>
        <?php if (isset($annonce['photo1'])) : ?>
          <div class="thumbnail">
            <img src="uploads/<?= $annonce['photo1'] ?>">
            <a href="#">Voir les autres photos</a>
          </div>
        <?php endif; ?>
        </td>
        <td><?= $annonce['titre_categorie']?></td>
        <td><?= $annonce['date_enregistrement']?></td>
        <td>
          <a href="annonce.php?id_annonce=<?= $annonce['id_annonce']?>">
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





 ?>
