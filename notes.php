<?php

require './model/index.php'; // calls $pdo + $options
require './templates/index.php';

include './templates/top.php';

$notes = getNotes();

viewListeNotes($notes);

include './templates/bottom.php';

 ?>
