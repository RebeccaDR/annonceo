<?php

  function getAnnonces () {
    global $pdo;

    $query = 'SELECT
              a.id_annonce, a.titre AS titre_annonce, a.description_courte, a.description_longue, a.prix, a.pays, a.ville, a.adresse, a.cp, membre.pseudo, photo.*, categorie.titre AS titre_categorie, a.date_enregistrement
              FROM annonce a
              LEFT JOIN membre ON a.membre_id = membre.id_membre
              LEFT JOIN photo ON a.photo_id = photo.id_photo
              LEFT JOIN categorie ON a.categorie_id = categorie.id_categorie
              ORDER BY id_annonce';
    $stmt = $pdo->query($query);

    return $stmt->fetchAll();
  }

  function getAnnonce ($idAnnonce) {
    global $pdo;

    $query = 'SELECT * FROM annonce WHERE id_annonce = ' . $idAnnonce;
    $stmt = $pdo->query($query);

    return $stmt->fetch();
  }

  function createAnnonce ($form) {
    global $pdo;

    $query = 'INSERT INTO annonce VALUES (null, :titre, :description_courte, :description_longue, :prix, :pays, :ville, :adresse, :cp, :membre_id, )';
  }

  function createPhoto ($form) {
    global $pdo;

    $query = 'INSERT INTO photo VALUES (null, :photo1, :photo2, :photo3, :photo4, :photo5)';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':photo1', $form['photo1'], PDO::PARAM_STR);
    $stmt->bindParam(':photo2', $form['photo2'], PDO::PARAM_STR);
    $stmt->bindParam(':photo3', $form['photo3'], PDO::PARAM_STR);
    $stmt->bindParam(':photo4', $form['photo4'], PDO::PARAM_STR);
    $stmt->bindParam(':photo5', $form['photo5'], PDO::PARAM_STR);

    $stmt->execute();
  }




 ?>
