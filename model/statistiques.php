<?php

function getMembresTopNotes () { // on récupère l'ensemble des catégories
  global $pdo;  // "global" appelle $pdo

  $query = 'SELECT membre.id_membre, membre.pseudo, AVG(note.note) AS note, COUNT(note.membre_id2) AS base_sur
    FROM membre
    RIGHT JOIN note ON note.membre_id2 = membre.id_membre
    GROUP BY membre.id_membre
    ORDER BY note DESC LIMIT 5'; // requête sql
  $stmt = $pdo->query($query); // on prépare la requête

  return $stmt->fetchAll(); // on exécute la requête / fetchAll() récupère l'ensemble des données
}

function getMembresTopActifs () { // on récupère l'ensemble des catégories
  global $pdo;  // "global" appelle $pdo

  $query = 'SELECT membre.id_membre, membre.pseudo, COUNT(annonce.id_annonce) AS nbAnnonces
    FROM membre
    RIGHT JOIN annonce ON annonce.membre_id = membre.id_membre
    GROUP BY membre.id_membre
    ORDER BY nbAnnonces DESC LIMIT 5'; // requête sql
  $stmt = $pdo->query($query); // on prépare la requête

  return $stmt->fetchAll(); // on exécute la requête / fetchAll() récupère l'ensemble des données
}

function getCategoriesTopAnnonces () { // on récupère l'ensemble des catégories
  global $pdo;  // "global" appelle $pdo

  $query = 'SELECT categorie.id_categorie, categorie.titre, COUNT(annonce.id_annonce) AS nbAnnonces
    FROM categorie
    RIGHT JOIN annonce ON annonce.categorie_id = categorie.id_categorie
    GROUP BY categorie.id_categorie
    ORDER BY nbAnnonces DESC LIMIT 5'; // requête sql
  $stmt = $pdo->query($query); // on prépare la requête

  return $stmt->fetchAll(); // on exécute la requête / fetchAll() récupère l'ensemble des données
}

function getAnnoncesTopCommentaires () { // on récupère l'ensemble des catégories
  global $pdo;  // "global" appelle $pdo

  $query = 'SELECT annonce.id_annonce, annonce.titre, COUNT(commentaire.id_commentaire) AS nbCommentaire
    FROM annonce
    RIGHT JOIN commentaire ON commentaire.annonce_id = annonce.id_annonce
    GROUP BY annonce.id_annonce
    ORDER BY nbCommentaire DESC LIMIT 5'; // requête sql
  $stmt = $pdo->query($query); // on prépare la requête

  return $stmt->fetchAll(); // on exécute la requête / fetchAll() récupère l'ensemble des données
}
