<?php

session_start();

include './model/index.php';
require './templates/index.php';


$user = getMembreByLogin($_REQUEST['pseudo'], $_REQUEST['mdp']);

if (!empty($user)) {
  setCurrentUser($user);
  // echo '<pre>';
  // print_r($user);
  // print_r($_SESSION);
  // echo '</pre>';
  header('Location: index.php');
} else {
  $errors = ['login'=> 'Utilisateur inconnu ou mot de passe erroné.'];
}

include './templates/top.php';

include './templates/bottom.php';

?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#loginModal').modal('show');
    });
</script>
<?php

 ?>
