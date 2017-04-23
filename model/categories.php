<?php

function getCategories () { // on récupère l'ensemble des catégories
  global $pdo;  // "global" appelle $pdo

  $query = 'SELECT * FROM categorie ORDER BY id_categorie'; // requête sql
  $stmt = $pdo->query($query); // on prépare la requête

  return $stmt->fetchAll(); // on exécute la requête / fetchAll() récupère l'ensemble des données
}

function getCategorie ($idCategorie) { // on récupère une catégorie spécifique par son id
  global $pdo;

  $query = 'SELECT * FROM categorie WHERE id_categorie = ' . $idCategorie;
  $stmt = $pdo->query($query);

  return $stmt->fetch(); // fetch() récupère une seule "ligne" du tableau.
}

function createCategorie ($form) { // on créé une nouvelle catégorie
  global $pdo;

  $query = 'INSERT INTO categorie VALUES (null, :titre, :motscles)'; // INSERT INTO ajoute les VALUES dans la table "categorie". La première valeur est "null" pour l'id_categorie qui se remplit automatiquement (AI), on récupère les valeurs ":titre" et ":motscles" ci-dessous.
  $stmt = $pdo->prepare($query); // on prépare la requête
  $stmt->bindParam(':titre', $form['titre'], PDO::PARAM_STR); // On joint la valeur de ":titre" à celle du "titre" présent dans le formulaire.
  $stmt->bindParam(':motscles', $form['motscles'], PDO::PARAM_STR); // idem pour :motscles

  $stmt->execute(); // On exécute la requête.
}

function updateCategorie ($idCategorie, $form) { // pour mettre à jour uen catégorie on a besoinde 2 paramètres, le premier sera l'id_categorie et le second prendra tout le formulaire)
  global $pdo;

  $query = 'UPDATE categorie SET titre = :titre, motscles = :motscles WHERE id_categorie = ' . $idCategorie;  // on update la categorie dans le tableau en récupérant son id.
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':titre', $form['titre'], PDO::PARAM_STR);
  $stmt->bindParam(':motscles', $form['motscles'], PDO::PARAM_STR);

  $stmt->execute();
}

function deleteCategorie ($idCategorie) { // on n'a besoin que de l'id de la catégorie pour la retrouver et la supprimer.
  global $pdo;

  $query = 'DELETE FROM categorie WHERE id_categorie = ' . $idCategorie;
  $pdo->exec($query);
}

// Vérification des erreurs du formulaire
function searchCategorie($titreCategorie) {
  global $pdo;

  $query = 'SELECT * FROM categorie WHERE titre LIKE "' . $titreCategorie . '"';

  $stmt = $pdo->query($query);

  return $stmt->fetchAll();
}


function checkCategorieForm ($form, $action) {
  $errors = []; // on créé une variable $errors qui contient un tableau (vide pour l'instant).

  if (!isset($form['titre']) || $form['titre'] == '') { // s'il la page n'a pas récupéré le paramètre "titre" dans le formulaire, ou si celui ci représente une chaîne de caratères vide.
     $errors['titre'] = 'Le titre est obligatoire.'; // $errors affichera alors dans la section 'titre' un message d'erreurs.
  }
  if (!isset($form['motscles']) || $form['motscles'] == '') { // idem pour la section "mots clés"
    $errors['motscles'] = 'Au moins un mot clé est obligatoire.'; // message d'erreur en cas d'absence de mot clé.
  }

  $sameTitreCategories = searchCategorie($form['titre']);
  if (count($sameTitreCategories) != 0 && $action == 'create') {
    $errors['titre'] = 'Une catégorie existe déjà sous ce nom';
  }

  return $errors; // Si la fonction a trouvé l'une ou l'autre des erreurs, $errors s'exécute dans la page, sinon, $errors restera un tableau vide.
}
