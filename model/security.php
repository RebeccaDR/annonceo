<?php

function getCurrentUser () {
  return $_SESSION['currentUser'];
}

function setCurrentUser ($user) {
  $_SESSION['currentUser'] = $user;
}

function isIdCurrentUser ($id) {
  return isUserConnected() && $_SESSION['currentUser']['id_membre'] == $id;
}

function isUserConnected() {
	return isset($_SESSION['currentUser']);
}

function isUserAdmin() {
	return isUserConnected() && $_SESSION['currentUser']['statut'] == 1;
}

function redirectUnauthorizedUsers($statut) {
  if ($statut == 'logged_user_only' && ! isUserConnected()) {
    securityRedirect('Accès réservé aux utilisateurs connectés');
  }
  if ($statut == 'admin_only' && ! isUserAdmin()) {
    securityRedirect('Accès refusé');
  }
}

function securityRedirect($msg = 'Accès refusé') {
  header('Location: 401.php?security='.$msg);
}

 ?>
