<?php

function getCurrentUser () {
  return $_SESSION['currentUser'];
}

function setCurrentUser ($user) {
  $_SESSION['currentUser'] = $user;
}

function isUserConnected() {
	return isset($_SESSION['currentUser']);
}

function isUserAdmin() {
	return isUserConnected() && $_SESSION['currentUser']['statut'] == 1;
}

function redirectUnauthorizedUsers() {
  if (! isUserConnected()) {
    securityRedirect('Accès réservé aux utilisateurs connectés');
  }
}

function securityRedirect($msg = 'Accès refusé') {
  header('Location: 401.php?security='.$msg);
}

 ?>
