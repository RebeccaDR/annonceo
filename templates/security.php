
<?php
function viewLoginForm () {
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
            <button type="submit" class="btn btn-primary">Se connecter</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php

}
