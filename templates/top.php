<?php
	require_once('./templates/security.php');
	require_once('./model/security.php');
	session_start();
 ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Annonceo</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./styles/index.css">
	</head>
		<body>
		<nav class="navbar navbar-default">
			<div class="container">
				<a class="navbar-brand" href="index.php">Annonceo</a>
				<ul class="nav navbar-nav navbar-right">
					<?php
					if (isUserAdmin()) :
					?>
					<li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          	<ul class="dropdown-menu">
							<li><a href="annonces.php">Annonces</a></li>
							<li><a href="membres.php">Membres</a></li>
							<li><a href="categories.php">Catégories</a></li>
							<li><a href="#">Commentaires</a></li>
	            <li><a href="#">Notes</a></li>
	            <li role="separator" class="divider"></li>
							<li><a href="#">Statistiques</a></li>
          	</ul>
        	</li>
					<?php
					endif;
					if (isUserConnected()) :
					?>
					<li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon espace <span class="caret"></span></a>
          	<ul class="dropdown-menu">
							<li><a href="#">Mon profil</a></li>
							<li><a href="#">Mes annonces</a></li>
							<li><a href="#">Mes avis</a></li>
	            <li role="separator" class="divider"></li>
							<li><a class="red-text" href="#">Déconnexion</a></li>
          	</ul>
        	</li>
				<?php
				else :
 				?>
					<li><a href="#" data-toggle="modal" data-target="#loginModal">Connexion</a></li>
				<?php
				endif;
				 ?>
				</ul>
			</div>
		</nav>
		<?= viewLoginForm(); ?>
		<div class="container">

			<?php print_r($_SESSION); ?>
