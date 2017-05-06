<?php

include ('./util/init.php');

if(isset($_REQUEST['pseudo']) && isset($_REQUEST['mdp'])) {
  $user = getMembreByLogin($_REQUEST['pseudo'], $_REQUEST['mdp']);

  if (!empty($user)) {
    setCurrentUser($user);
    header('Location: index.php');
  } else {
    $errors = ['login'=> 'Utilisateur inconnu ou mot de passe erroné.'];
  }
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
