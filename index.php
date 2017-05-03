<?php

  // Force display of errors
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Require Model & template functions
  require './model/index.php';
  require './templates/index.php';

  include './templates/top.php';

  if (isset($_REQUEST['create_success'])) {
    echo '<div class="alert alert-success" role="alert">Votre compte a été créé avec succès</div>';
  }

  echo 'coucou';

  include './templates/bottom.php';

  if (isset($_REQUEST['create_success'])) {
    ?>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#loginModal').modal('show');
        });
    </script>
    <?php
  }
