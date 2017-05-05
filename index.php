<?php

include ('./util/init.php');

viewTop();

if (isset($_REQUEST['create_success'])) {
  echo '<div class="alert alert-success" role="alert">Votre compte a été créé avec succès</div>';
}

if (isUserConnected()) {
  echo '<h2>Bienvenue ' . $currentUser['pseudo'] . '</h2>';
  echo '<p>Nous sommes ravis de vous revoir !</p>';
} else {
  echo '<h2>Bienvenue sur Annonceo</h2>';
}

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
