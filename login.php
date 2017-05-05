<?php

include ('./util/init.php');


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

viewTop();

viewBottom();

?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#loginModal').modal('show');
    });
</script>
<?php

 ?>
