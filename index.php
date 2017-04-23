<?php

  // Force display of errors
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Require Model & template functions
  // require './model/index.php';
  // require './templates/index.php';

  include './templates/top.php';

  echo 'coucou';
  
  include './templates/bottom.php';
