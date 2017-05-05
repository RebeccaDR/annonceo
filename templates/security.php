
<?php

require_once('./templates/membres.php');

function viewLoginForm ($errors) {
  ?>

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="loginModalLabel">Connexion</h4>
        </div>
        <form action="login.php" method="post">
          <div class="modal-body">
            <?php
            if (isset($errors['login'])) {
              ?> <div class="alert alert-danger" role="alert"><?= $errors['login'] ?> </div>
              <?php
            }
             ?>
            <div class="form-group">
              <label class="control-label">Pseudo</label>
              <input class="form-control" type="text" name="pseudo" placeholder="Votre pseudo" >
            </div>
            <div class="form-group">
              <label class="control-label">Mot de passe</label>
              <input class="form-control" type="password" name="mdp" placeholder="Votre mot de passe" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary btn-security">Se connecter</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php

}

function viewSignupForm ($membre = [], $errors = []) {
?>

  <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="signupModalLabel">Inscription</h4>
        </div>
        <form action="signup.php" method="post">
          <div class="modal-body">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="id_membre" value="">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
          </div>
        </form>


      </div>
    </div>
  </div>

<?php
}

 ?>
