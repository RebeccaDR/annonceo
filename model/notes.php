<?php

function getNotes () {
  global $pdo;

  $query = 'SELECT
            n.*, m1.pseudo AS pseudo1, m2.pseudo AS pseudo2
            FROM note n
            LEFT JOIN membre AS m1 ON n.membre_id1 = m1.id_membre
            LEFT JOIN membre AS m2 ON n.membre_id2 = m2.id_membre
            ORDER BY date_enregistrement';
  $stmt = $pdo->query($query);

  return $stmt->fetchAll();
}

function getNote ($idNote) {
  global $pdo;

  $query = 'SELECT
            n.*, m1.pseudo AS pseudo1, m2.pseudo AS pseudo2
            FROM note n
            LEFT JOIN membre AS m1 ON n.membre_id1 = m1.id_membre
            LEFT JOIN membre AS m2 ON n.membre_id2 = m2.id_membre
            WHERE id_note = ' . $idNote;
  $stmt = $pdo->query($query);

  return $stmt->fetch();
}

function getNoteByUsers ($id1, $id2) {
  global $pdo;

  $query = 'SELECT
            n.*, m1.pseudo AS pseudo1, m2.pseudo AS pseudo2
            FROM note n
            LEFT JOIN membre AS m1 ON n.membre_id1 = m1.id_membre
            LEFT JOIN membre AS m2 ON n.membre_id2 = m2.id_membre
            WHERE n.membre_id1 = ' . $id1 . '
            AND n.membre_id2 = ' . $id2;
  $stmt = $pdo->query($query);

  return $stmt->fetch();
}

function createNote ($form) {
  global $pdo;

  $query = 'INSERT INTO note VALUES (null, :membre_id1, :membre_id2, :note, :avis, NOW())';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':membre_id1', $form['membre_id1'], PDO::PARAM_INT);
    $stmt->bindParam(':membre_id2', $form['membre_id2'], PDO::PARAM_INT);
    $stmt->bindParam(':note', $form['note'], PDO::PARAM_INT);
    $stmt->bindParam(':avis', $form['avis'], PDO::PARAM_STR);

    $stmt->execute();
}

function updateNote ($idNote, $form) {
  global $pdo;

  $query = 'UPDATE note SET
    membre_id1 = :membre_id1,
    membre_id2 = :membre_id2,
    note = :note,
    avis = :avis WHERE id_note = '. $idNote;

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':membre_id1', $form['membre_id1'], PDO::PARAM_INT);
    $stmt->bindParam(':membre_id2', $form['membre_id2'], PDO::PARAM_INT);
    $stmt->bindParam(':note', $form['note'], PDO::PARAM_INT);
    $stmt->bindParam(':avis', $form['avis'], PDO::PARAM_STR);

    $stmt->execute();
}

function deleteNote ($idNote) {
  global $pdo;

  $query = 'DELETE FROM note WHERE id_note = ' . $idNote;
  $pdo->exec($query);
}
?>
