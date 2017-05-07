<?php

include ('./util/init.php');

$categories = getCategories();
$lastAnnonces = getAnnonces(null, null, null, null, 4);

viewTop();

if (isset($_REQUEST['create_success'])) {
  echo '<div class="alert alert-success" role="alert">Votre compte a été créé avec succès</div>';
}

?>

<div class="col-md-8">
  <?php
  if (isUserConnected()) {
    echo '<div class="panel panel-default"><h2 style="color: #1B62B2;">Bienvenue ' . $currentUser['pseudo'] . '</h2>';
    echo '<p>Nous sommes ravis de vous revoir !</p></div>';
  } else {
    echo '<div class="panel panel-default"><h2 style="color: #1B62B2;">Bienvenue sur Annonceo</h2>';
    echo '<p>Vous souhaitez vendre quelque chose ? Acheter quelque chose ! C\'est ici que ça se passe !</p></div>';
  }

  viewAnnoncesSmall($lastAnnonces);

  ?>
</div>

<div class="col-md-4">
  <div class="panel panel-default" style="color: #1B62B2; font-size: 1.2em;">
    <p style="text-align: center;"><strong>ANN<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>NCEO</strong> est une plateforme qui permet de vendre, acheter, échanger, sur toute la France, <strong>gratuitement</strong> et <strong>sans commission</strong>.</p>
  </div>

  <div class="panel panel-default" style="background-color: #FF685A; text-align: center;">
    <a <?= isUserConnected() ? 'href="annonce.php"' : 'href="#" data-toggle="modal" data-target="#loginModal"' ?> style="color: #FFF; font-size: 1.2em;">
      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Créer une annonce
    </a>
  </div>
  <div class="panel panel-default" style="background-color: #1B62B2; text-align: center;">
    <a href="annonces.php" style="color: #FFF; font-size: 1.2em;">
      <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Chercher une annonce
    </a>
  </div>

  <div class="panel panel-default">
    <h2 style="color: #FF685A;">Catégories</h2>
    <ul>
      <?php
      foreach ($categories as $categorie) :
        ?>
        <li>
          <a href="annonces.php?categorie=<?= $categorie['id_categorie'] ?>"><?= $categorie['titre'] ?></a>
        </li>
      <?php
    endforeach;
       ?>
    </ul>
  </div>
</div>


<?php
viewBottom();

if (isset($_REQUEST['create_success'])) {
  ?>
  <script type="text/javascript">
      $(window).on('load',function(){
          $('#loginModal').modal('show');
      });
  </script>
  <?php
}
