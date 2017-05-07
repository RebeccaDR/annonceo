<?php

  function getAnnonces ($search = '', $categorie = '', $limit = '') {
    global $pdo;

    $query = 'SELECT
              a.id_annonce, a.titre AS titre_annonce, a.description_courte, a.description_longue, a.prix, a.pays, a.ville, a.adresse, a.cp, membre.pseudo, a.membre_id, photo.*, categorie.titre AS titre_categorie, a.date_enregistrement
              FROM annonce a
              LEFT JOIN membre ON a.membre_id = membre.id_membre
              LEFT JOIN photo ON a.photo_id = photo.id_photo
              LEFT JOIN categorie ON a.categorie_id = categorie.id_categorie ';

    if ($search != '' || $categorie != '') {
      $query .= 'WHERE ';
    }
    if ($search != '') {
      $search = addslashes($search);
      $query .= '(a.titre LIKE "%' . $search . '%" OR a.description_courte LIKE "%' . $search . '%" OR a.description_longue LIKE "%' . $search . '%")';
    }
    if ($search != '' && $categorie != '') {
      $query .= 'AND ';
    }
    if ($categorie != '') {
      $categorie = addslashes($categorie);
      $query .= 'a.categorie_id = ' . $categorie;
    }

    $query.= ' ORDER BY date_enregistrement DESC';

    if ($limit != '') {
      $query .= ' LIMIT ' . $limit;
    }

    $stmt = $pdo->query($query);

    return $stmt->fetchAll();
  }

  function getAnnoncesByUser ($membre_id) {
    global $pdo;

    $query = 'SELECT
              a.id_annonce, a.titre AS titre_annonce, a.description_courte, a.description_longue, a.prix, a.pays, a.ville, a.adresse, a.cp, membre.pseudo, a.membre_id, photo.*, categorie.titre AS titre_categorie, a.date_enregistrement
              FROM annonce a
              LEFT JOIN membre ON a.membre_id = membre.id_membre
              LEFT JOIN photo ON a.photo_id = photo.id_photo
              LEFT JOIN categorie ON a.categorie_id = categorie.id_categorie
              WHERE a.membre_id = ' . $membre_id . '
              ORDER BY date_enregistrement DESC';
    $stmt = $pdo->query($query);

    return $stmt->fetchAll();
  }

  function getAnnonce ($idAnnonce) {
    global $pdo;

    $query = 'SELECT
      a.id_annonce, a.titre AS titre_annonce, a.description_courte, a.description_longue, a.prix, a.pays, a.ville, a.adresse, a.cp, membre.pseudo, a.photo_id, a.membre_id, photo.*, categorie.id_categorie, categorie.titre AS titre_categorie, a.date_enregistrement, COUNT(id_commentaire) AS nb_commentaires
      FROM annonce a
      LEFT JOIN membre ON a.membre_id = membre.id_membre
      LEFT JOIN photo ON a.photo_id = photo.id_photo
      LEFT JOIN categorie ON a.categorie_id = categorie.id_categorie
      LEFT JOIN commentaire ON a.id_annonce = commentaire.annonce_id
      WHERE a.id_annonce = ' . $idAnnonce . ' GROUP BY a.id_annonce;';
    $stmt = $pdo->query($query);

    return $stmt->fetch();
  }

  function createAnnonce ($form) {
    global $pdo;

    $query = 'INSERT INTO annonce VALUES (null, :titre, :description_courte, :description_longue, :prix, :pays, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, NOW())';

      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':titre', $form['titre'], PDO::PARAM_STR);
      $stmt->bindParam(':description_courte', $form['description_courte'], PDO::PARAM_STR);
      $stmt->bindParam(':description_longue', $form['description_longue'], PDO::PARAM_STR);
      $stmt->bindParam(':prix', $form['prix'], PDO::PARAM_STR);
      $stmt->bindParam(':pays', $form['pays'], PDO::PARAM_STR);
      $stmt->bindParam(':ville', $form['ville'], PDO::PARAM_STR);
      $stmt->bindParam(':adresse', $form['adresse'], PDO::PARAM_STR);
      $stmt->bindParam(':cp', $form['cp'], PDO::PARAM_INT);
      $stmt->bindParam(':membre_id', $form['membre_id'], PDO::PARAM_INT);
      $stmt->bindParam(':photo_id', $form['photo_id'], PDO::PARAM_INT);
      $stmt->bindParam(':categorie_id', $form['categorie_id'], PDO::PARAM_INT);

      $stmt->execute();
  }

  function updateAnnonce ($idAnnonce, $form) {
    global $pdo;

    $query = 'UPDATE annonce SET
      titre = :titre,
      description_courte = :description_courte,
      description_longue = :description_longue,
      prix = :prix,
      pays = :pays,
      ville = :ville,
      adresse = :adresse,
      cp = :cp,
      categorie_id = :categorie_id WHERE id_annonce = '. $idAnnonce;

      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':titre', $form['titre'], PDO::PARAM_STR);
      $stmt->bindParam(':description_courte', $form['description_courte'], PDO::PARAM_STR);
      $stmt->bindParam(':description_longue', $form['description_longue'], PDO::PARAM_STR);
      $stmt->bindParam(':prix', $form['prix'], PDO::PARAM_STR);
      $stmt->bindParam(':pays', $form['pays'], PDO::PARAM_STR);
      $stmt->bindParam(':ville', $form['ville'], PDO::PARAM_STR);
      $stmt->bindParam(':adresse', $form['adresse'], PDO::PARAM_STR);
      $stmt->bindParam(':cp', $form['cp'], PDO::PARAM_INT);
      $stmt->bindParam(':categorie_id', $form['categorie_id'], PDO::PARAM_INT);

      $stmt->execute();
  }

  function checkAnnonceForm ($form) {
    $errors = [];
    $photoErrors = checkPhotos();

    return array_merge($errors, $photoErrors);
  }

  function createPhoto ($form) {
    global $pdo;

    $uploadedPhotoNames = array_merge($form, processPhotoUpload());

    $query = 'INSERT INTO photo VALUES (null, :photo1, :photo2, :photo3, :photo4, :photo5)';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':photo1', $uploadedPhotoNames['photo1'], PDO::PARAM_STR);
    $stmt->bindParam(':photo2', $uploadedPhotoNames['photo2'], PDO::PARAM_STR);
    $stmt->bindParam(':photo3', $uploadedPhotoNames['photo3'], PDO::PARAM_STR);
    $stmt->bindParam(':photo4', $uploadedPhotoNames['photo4'], PDO::PARAM_STR);
    $stmt->bindParam(':photo5', $uploadedPhotoNames['photo5'], PDO::PARAM_STR);

    $stmt->execute();

    return $pdo->lastInsertId();
  }

  function updatePhoto ($idPhoto, $form) {
    global $pdo;
    $uploadedPhotoNames = array_merge($form, processPhotoUpload());

    $query = 'UPDATE photo SET photo1 = :photo1, photo2 = :photo2, photo3 = :photo3, photo4 = :photo4, photo5 = :photo5 WHERE id_photo = ' . $idPhoto;

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':photo1', $uploadedPhotoNames['photo1'], PDO::PARAM_STR);
    $stmt->bindParam(':photo2', $uploadedPhotoNames['photo2'], PDO::PARAM_STR);
    $stmt->bindParam(':photo3', $uploadedPhotoNames['photo3'], PDO::PARAM_STR);
    $stmt->bindParam(':photo4', $uploadedPhotoNames['photo4'], PDO::PARAM_STR);
    $stmt->bindParam(':photo5', $uploadedPhotoNames['photo5'], PDO::PARAM_STR);

    $stmt->execute();

    return $pdo->lastInsertId();
  }

  function getPhoto ($idPhoto) {
    global $pdo;

    $query = 'SELECT * FROM photo WHERE id_photo = ' . $idPhoto;
    $stmt = $pdo->query($query);

    return $stmt->fetch();
  }

  function processPhotoUpload () {
    $savedAs = [];
    $target_dir = "uploads/";

    foreach ($_FILES as $key => $upload) {
      if (! isset($upload['tmp_name']) || $upload['tmp_name'] == '') {
        continue;
      }

      $uniqueFileName = time() . '-' . basename($upload["name"]);
      $target_file = $target_dir . $uniqueFileName;

      $savedAs[$key] = $uniqueFileName;
      move_uploaded_file($upload["tmp_name"], $target_file);
    }

    return $savedAs;
  }

  function checkPhotos () {
    $errors = [];

    foreach ($_FILES as $key => $upload) {
      if (! isset($upload['tmp_name']) || $upload['tmp_name'] == '') {
        continue;
      }

      $imageFileType = pathinfo($upload['name'], PATHINFO_EXTENSION);

      // Check file size
      if ($upload["size"] > 5000000) {
        $errors[$key] = "La taille du fichier ne doit pas excéder 5Mo.";
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $errors[$key] = "Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
      }
    }

    return $errors;
  }

 ?>
