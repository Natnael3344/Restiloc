<?php
include('connexion_bdd.php');

if(isset($_POST['submit'])) {
    $dossier_vehicule = $_POST['dossier_vehicule'];
    $dossier_expert = $_POST['dossier_expert'];
    $dossier_rendez_vous = $_POST['dossier_rendez_vous'];
    $dossier_date = $_POST['dossier_date'];
    $piece = $_POST['piece'];
    $description = $_POST['description'];
    $quantite = $_POST['quantite'];
    $peinture = $_POST['peinture'];
    $photo = $_POST['photo'];
    $id_vehicule = $_POST['id_vehicule'];

    $lien = connect_to_db();
    $stmt = $lien->prepare("INSERT INTO dossier_restitution (dossier_vehicule, dossier_expert, dossier_rendez_vous, dossier_date, piece, description, quantite, peinture, photo, id_vehicule) VALUES (:dossier_vehicule, :dossier_expert, :dossier_rendez_vous, :dossier_date, :piece, :description, :quantite, :peinture, :photo, :id_vehicule)");
    $stmt->bindParam(':dossier_vehicule', $dossier_vehicule);
    $stmt->bindParam(':dossier_expert', $dossier_expert);
    $stmt->bindParam(':dossier_rendez_vous', $dossier_rendez_vous);
    $stmt->bindParam(':dossier_date', $dossier_date);
    $stmt->bindParam(':piece', $piece);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':peinture', $peinture);
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':id_vehicule', $id_vehicule);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data";
    }
}
?>
