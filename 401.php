<?php

  include ('./util/init.php');

  viewTop();

  if (isset($_REQUEST['security'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_REQUEST['security'] . '</div>';
  }

  ?>

  <a href="index.php">retour à la page d'accueil</a>
  <?php

  viewBottom();
