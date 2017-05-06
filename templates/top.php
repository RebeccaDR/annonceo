<?php
	function viewTop () {
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
		<link href="https://fonts.googleapis.com/css?family=Muli:400,600,700" rel="stylesheet">
	</head>
		<body>
		<nav class="navbar navbar-default">
			<div class="container navbar-container">
				<a class="navbar-brand" href="index.php">ANN<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>NCEO</a>
				<ul class="nav navbar-nav navbar-left">
					<li><a href="annonces.php">Toutes les annonces</a></li>
					<?php
						if (isUserConnected()):
					 ?>
					<li><a href="annonce.php">Créer une annonce</a></li>
					<?php
						endif;
					 ?>
				</ul>
				<form class="navbar-form navbar-left" action="annonces.php" method="get">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Rechercher des annonces" name="search">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default">Go !</button>
						</span>
					</div>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<?php
					if (isUserAdmin()) :
					?>
					<li class="dropdown">
          	<a href="#" class="dropdown-toggle blue-text" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          	<ul class="dropdown-menu">
							<li><a href="annonces.php">Annonces</a></li>
							<li><a href="membres.php">Membres</a></li>
							<li><a href="categories.php">Catégories</a></li>
							<li><a href="commentaires.php">Commentaires</a></li>
	            <li><a href="notes.php">Notes</a></li>
	            <li role="separator" class="divider"></li>
							<li><a href="statistiques.php">Statistiques</a></li>
          	</ul>
        	</li>
					<?php
					endif;
					if (isUserConnected()) :
						$user = getCurrentUser();
					?>
					<li class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Mon espace <span class="caret"></span></a>
          	<ul class="dropdown-menu">
							<li><a href="profil.php?id=<?= $user['id_membre']?>">Mon profil</a></li>
							<li><a href="annonces.php?id=<?= $user['id_membre']?>">Mes annonces</a></li>
							<li><a href="notes.php?id=<?= $user['id_membre']?>">Mes avis</a></li>
	            <li role="separator" class="divider"></li>
							<li><a class="red-text" href="./logout.php">Déconnexion</a></li>
          	</ul>
        	</li>
				<?php
				else :
 				?>
					<li><a href="#" data-toggle="modal" data-target="#loginModal">Connexion</a></li>
					<li><a href="#" data-toggle="modal" data-target="#signupModal">Inscription</a></li>
				<?php
				endif;
				 ?>
				</ul>
			</div>
		</nav>
		<?php
		if (!isset($membre)) {
			$membre = [];
		}
		if (!isset($errors)) {
			$errors = [];
		}
		viewLoginForm($errors);
		viewSignupForm($membre, $errors);
		?>

		<div class="container">
<?php
	}
?>
