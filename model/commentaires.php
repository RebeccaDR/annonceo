<?php

function getCommentaires () {
  global $pdo;

  $query = 'SELECT
            c.*, membre.id_membre, membre.pseudo, annonce.id_annonce, annonce.titre
            FROM commentaire c
            LEFT JOIN membre ON c.membre_id = membre.id_membre
            LEFT JOIN annonce ON c.annonce_id = annonce.id_annonce
            ORDER BY date_enregistrement';
  $stmt = $pdo->query($query);

  return $stmt->fetchAll();
}

function getCommentairesByAnnonce ($idAnnonce) {
  global $pdo;

  $query = 'SELECT
            c.*, membre.id_membre, membre.pseudo
            FROM commentaire c
            LEFT JOIN membre ON c.membre_id = membre.id_membre
            WHERE c.annonce_id = ' . $idAnnonce . '
            ORDER BY date_enregistrement';
  $stmt = $pdo->query($query);

  return $stmt->fetchAll();
}

function getCommentaire ($idCommentaire) {
  global $pdo;

  $query = 'SELECT
            c.*, membre.id_membre, membre.pseudo, annonce.id_annonce, annonce.titre
            FROM commentaire c
            LEFT JOIN membre ON c.membre_id = membre.id_membre
            LEFT JOIN annonce ON c.annonce_id = annonce.id_annonce
            WHERE id_commentaire = ' . $idCommentaire;
  $stmt = $pdo->query($query);

  return $stmt->fetch();
}

function createCommentaire ($form) {
  global $pdo;

  $query = 'INSERT INTO commentaire VALUES (null, :membre_id, :annonce_id, :commentaire, NOW())';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':membre_id', $form['membre_id'], PDO::PARAM_INT);
    $stmt->bindParam(':annonce_id', $form['annonce_id'], PDO::PARAM_INT);
    $stmt->bindParam(':commentaire', $form['commentaire'], PDO::PARAM_STR);

    $stmt->execute();
}

function updateCommentaire ($idCommentaire, $form) {
  global $pdo;

  $query = 'UPDATE commentaire SET
    membre_id = :membre_id,
    annonce_id = :annonce_id,
    commentaire = :commentaire WHERE id_commentaire = '. $idCommentaire;

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':membre_id', $form['membre_id'], PDO::PARAM_INT);
    $stmt->bindParam(':annonce_id', $form['annonce_id'], PDO::PARAM_INT);
    $stmt->bindParam(':commentaire', $form['commentaire'], PDO::PARAM_STR);

    $stmt->execute();
}

function deleteCommentaire ($idCommentaire) {
  global $pdo;

  $query = 'DELETE FROM commentaire WHERE id_commentaire = ' . $idCommentaire;
  $pdo->exec($query);
}
 ?>
