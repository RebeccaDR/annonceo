<?php

function getMembres () {
  global $pdo;

  $query = 'SELECT * FROM membre ORDER BY id_membre';
  $stmt = $pdo->query($query);

  return $stmt->fetchAll();
}

function getMembre ($idMembre) {
  global $pdo;

  $query = 'SELECT membre.*, AVG(note.note) AS note, COUNT(note.membre_id2) AS nb_notes FROM membre
        LEFT JOIN note ON note.membre_id2 = membre.id_membre
        WHERE id_membre = ' . $idMembre . '
        GROUP BY membre.id_membre';
	$stmt = $pdo->query($query);

  return $stmt->fetch();
}

function getMembreByLogin ($pseudo, $mdp) {
  global $pdo;

  $query = 'SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp';

  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
  $stmt->bindValue(':mdp', sha1($mdp), PDO::PARAM_STR);
  $stmt->execute();

  return $stmt->fetch();
}

function createMembre ($form) {
  global $pdo;

  if (!isset($form['statut'])) {
    $form['statut'] = 0;
  }

  $query = 'INSERT INTO membre VALUES (null, :pseudo, :mdp, :nom, :prenom, :email, :telephone, :civilite, :statut, NOW())';
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':pseudo',               $form['pseudo'], PDO::PARAM_STR);
  $stmt->bindParam(':mdp',                  sha1($form['mdp']), PDO::PARAM_STR);
  $stmt->bindParam(':nom',                  $form['nom'], PDO::PARAM_STR);
  $stmt->bindParam(':prenom',               $form['prenom'], PDO::PARAM_STR);
  $stmt->bindParam(':email',                $form['email'], PDO::PARAM_STR);
  $stmt->bindParam(':telephone',            $form['telephone'], PDO::PARAM_STR);
  $stmt->bindParam(':civilite',             $form['civilite'], PDO::PARAM_STR);
  $stmt->bindParam(':statut',               $form['statut'], PDO::PARAM_INT);

  if ($stmt->execute()) {
    return $pdo->lastInsertId();
  } else {
    return false;
  }
}

function updateMembre ($idMembre, $form) {
  global $pdo;

  $query = 'UPDATE membre SET pseudo = :pseudo, mdp = :mdp, nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, civilite = :civilite, statut = :statut WHERE id_membre = ' . $idMembre;
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':pseudo',               $form['pseudo'], PDO::PARAM_STR);
  $stmt->bindParam(':mdp',                  sha1($form['mdp']), PDO::PARAM_STR);
  $stmt->bindParam(':nom',                  $form['nom'], PDO::PARAM_STR);
  $stmt->bindParam(':prenom',               $form['prenom'], PDO::PARAM_STR);
  $stmt->bindParam(':email',                $form['email'], PDO::PARAM_STR);
  $stmt->bindParam(':telephone',            $form['telephone'], PDO::PARAM_STR);
  $stmt->bindParam(':civilite',             $form['civilite'], PDO::PARAM_STR);
  $stmt->bindParam(':statut',               $form['statut'], PDO::PARAM_INT);;

  $stmt->execute();
}

function deleteMembre ($idMembre) {
  global $pdo;

  $query = 'DELETE FROM membre WHERE id_membre = ' . $idMembre;
  $pdo->exec($query);
}

function searchMembres($pseudoMembre) {
  global $pdo;

  $query = 'SELECT * FROM membre WHERE pseudo LIKE "' . $pseudoMembre . '"';

  $stmt = $pdo->query($query);

  return $stmt->fetchAll();
}

function checkMembreForm ($form, $action) {
  $errors = [];

  if (!isset($form['pseudo']) || $form['pseudo'] == '') {
    $errors['pseudo'] = 'Le pseudo est obligatoire.';
  }
  if (!isset($form['mdp']) || $form['mdp'] == '') {
    $errors['mdp'] = 'Le mot de passe est obligatoire.';
  }
  if ($form['mdp'] != $form['confirm_mdp']) {
    $errors['confirm_mdp'] = 'Veuiller confirmer le mot de passe.';
  }
  if (!isset($form['nom']) || $form['nom'] == '') {
    $errors['nom'] = 'Le nom est obligatoire.';
  }
  if (!isset($form['prenom']) || $form['prenom'] == '') {
    $errors['prenom'] = 'Le prénom est obligatoire.';
  }
  if (!isset($form['email']) || $form['email'] == '') {
    $errors['email'] = 'L\'email est obligatoire.';
  }
  if (!isset($form['telephone']) || $form['telephone'] == '') {
    $errors['telephone'] = 'Le téléphone est obligatoire.';
  }

  $samePseudoMembres = searchMembres($form['pseudo']);
  if (count($samePseudoMembres) != 0 && $action == 'create') {
    $errors['pseudo'] = 'Un utilisateur existe déjà sous ce nom';
  }

  return $errors;
}
