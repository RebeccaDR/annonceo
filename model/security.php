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


 ?>
