<?php

require './model/index.php';
require './templates/index.php';



if (isset($_REQUEST['action'])) {
  $errors = checkMembreForm($_REQUEST, $_REQUEST['action']);

  if ($_REQUEST['action'] == 'create' && count($errors) == 0) {
    createMembre($_REQUEST);
    header('Location: index.php?create_success=true');
  }

  $membre = $_REQUEST;

} else {
  $errors = [];
  $membre = [];
}


include './templates/top.php';


include './templates/bottom.php';

?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#signupModal').modal('show');
    });
</script>
<?php
 ?>
