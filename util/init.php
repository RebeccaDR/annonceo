<?php

// Require Model & template functions
require './model/index.php';
require './templates/index.php';

if (!isset($_SESSION)) {
  session_start();
}

if (isUserConnected()) {
  $currentUser = getCurrentUser();
}
