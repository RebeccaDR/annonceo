<?php

function viewListeMembres ($membres) {
  ?>
  <table class="table table-striped table-bordered">
    <tr>
      <th>id</th>
      <th>pseudo</th>
      <th>nom</th>
      <th>prenom</th>
      <th>email</th>
      <th>telephone</th>
      <th>civilite</th>
      <th>statut</th>
      <th>date_enregistrement</th>
      <th>actions</th>
    </tr>

    <?php
			foreach ($membres as $membre):
		?>
    <tr>
			<td><?= $membre['id_membre']?></td>
      <td><?= $membre['pseudo']?></td>
      <td><?= $membre['nom']?></td>
      <td><?= $membre['prenom']?></td>
      <td><?= $membre['email']?></td>
      <td><?= $membre['telephone']?></td>
      <td><?= $membre['civilite']?></td>
      <td><?= $membre['statut']?></td>
      <td><?= $membre['date_enregistrement']?></td>
      <td><a href="membre.php?id_membre=<?= $membre['id_membre']?>">
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

// if the parameter $membre is set, it's an edit form, if not, it's a new member form
function viewMembreForm ($membre, $errors) {
  $idMembreExists = isset($membre['id_membre']) && $membre['id_membre'] != '';

  if ($idMembreExists) {
    $formTitle = 'Modifier un utilisateur';
  } else {
    $formTitle = 'Créer un utilisateur';
  }

  ?>
    <h2><?= $formTitle ?></h2>
    <form action="membre.php" method="post">
      <input type="hidden" name="action" value="<?= $idMembreExists ? 'update' : 'create' ?>">
      <input type="hidden" name="id_membre" value="<?= $idMembreExists ? $membre['id_membre'] : '' ?>">
      <div class="form-group">
        <label class="control-label">Pseudo</label>
        <input
          class="form-control" type="text" name="pseudo" placeholder="Votre pseudo"
          value="<?= isset($membre['pseudo']) ? $membre['pseudo'] : '' ?>"
        >
        <span class="form-error-label"><?= isset($errors['pseudo']) ? $errors['pseudo'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Mot de passe</label>
        <input
          class="form-control" type="password" name="mdp" placeholder="Votre Mot de passe"
          value="<?= isset($membre['mdp']) ? $membre['mdp'] : '' ?>"
        >
        <span class="form-error-label"><?= isset($errors['mdp']) ? $errors['mdp'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Confirmez le mot de passe</label>
        <input
          class="form-control" type="password" name="confirm_mdp" placeholder="Confirmez le mot de passe"
          value=""
        >
        <span class="form-error-label"><?= isset($errors['confirm_mdp']) ? $errors['confirm_mdp'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Nom</label>
        <input
          class="form-control" type="text" name="nom" placeholder="Votre nom"
          value="<?= isset($membre['nom']) ? $membre['nom'] : '' ?>"
        >
        <span class="form-error-label"><?= isset($errors['nom']) ? $errors['nom'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Prenom</label>
        <input
          class="form-control" type="text" name="prenom" placeholder="Votre prenom"
          value="<?= isset($membre['prenom']) ? $membre['prenom'] : '' ?>"
        >
        <span class="form-error-label"><?= isset($errors['prenom']) ? $errors['prenom'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Email</label>
        <input
          class="form-control" type="text" name="email" placeholder="Votre email"
          value="<?= isset($membre['email']) ? $membre['email'] : '' ?>"
        >
        <span class="form-error-label"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Téléphone</label>
        <input
          class="form-control" type="text" name="telephone" placeholder="Votre telephone"
          value="<?= isset($membre['telephone']) ? $membre['telephone'] : '' ?>"
        >
        <span class="form-error-label"><?= isset($errors['telephone']) ? $errors['telephone'] : '' ?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Civilite</label>
        <select name="civilite" class="form-control">
          <option value="m" <?= isset($membre['civilite']) && $membre['civilite'] == 'm' ? 'selected="selected"' : '' ?>>Homme</option>
          <option value="f" <?= isset($membre['civilite']) && $membre['civilite'] == 'f' ? 'selected="selected"' : '' ?>>Femme</option>
        </select>
      </div>
      <?php
      if (isUserAdmin()) {
       ?>
      <div class="form-group">
        <label class="control-label">Droits</label>
        <select name="statut" class="form-control">
          <option value="0" <?= isset($membre['statut']) && $membre['statut'] == '0' ? 'selected="selected"' : '' ?>>Utilisateur simple</option>
          <option value="1" <?= isset($membre['statut']) && $membre['statut'] == '1' ? 'selected="selected"' : '' ?>>Admin</option>
        </select>
      </div>
      <?php
      } else {
      ?>
      <input type="hidden" name="statut" value="<?= isset($membre['statut']) ? $membre['statut'] : '' ?>">
      <?php
      }
       ?>
      <input class="btn btn-primary" type="submit" value="<?= $idMembreExists ? 'Mettre à jour' : 'Créer un nouveau membre' ?>"/>
    </form>
  <?php
}

function viewMembreProfil ($membre) {
  ?>
  <p>
    <b>Pseudo :</b> <?= $membre['pseudo'] ?>
  </p>
  <p>
    <b>Prénom / Nom  :</b> <?= $membre['prenom'] ?> <?= $membre['nom'] ?>
  </p>
  <p>
    <b>Email :</b> <?= $membre['email'] ?>
  </p>
  <p>
    <b>Téléphone :</b> <?= $membre['telephone'] ?>
  </p>
  <p>
    <b>Civilite :</b> <?= $membre['civilite'] ?>
  </p>
  <p>
    <b>Date d'inscription :</b> <?= $membre['date_enregistrement'] ?>
  </p>
  <p>
    <b>Note utilisateurs :</b> <?= viewStars($membre['note']) ?> (basé sur <?= isset($membre['nb_notes']) ? $membre['nb_notes'] : 0 ?> notes)
  </p>
  <?php
}
