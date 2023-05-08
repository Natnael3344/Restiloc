
<?php
include('connexion_bdd.php');

$lien = connect_to_db();


//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('SELECT * FROM garage');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = array(); 
foreach($rows as $enregistrement) {
    if (isset($enregistrement['id_garage'])) {
        $id_garage_tab = $enregistrement['id_garage'];
    } else {
        $id_garage_tab = "";
    }
    if (isset($enregistrement['nom_garage'])) {
        $nom_garage_tab = $enregistrement['nom_garage'];
    } else {
        $nom_garage_tab = "";
    }
    if (isset($enregistrement['adresse_garage'])) {
        $adresse_garage_tab = $enregistrement['adresse_garage'];
    } else {
        $adresse_garage_tab = "";
    }
    if (isset($enregistrement['cp_garage'])) {
        $cp_garage_tab = $enregistrement['cp_garage'];
    } else {
        $cp_garage_tab = "";
    }
    if (isset($enregistrement['ville_garage'])) {
        $ville_garage_tab = $enregistrement['ville_garage'];
    } else {
        $ville_garage_tab = "";
    }
    if (isset($enregistrement['tel_garage'])) {
        $tel_garage_tab = $enregistrement['tel_garage'];
    } else {
        $tel_garage_tab = "";
    }
    $result = array(
        'id_garage' => $id_garage_tab,
        'nom_garage' => $nom_garage_tab,
        'adresse_garage' => $adresse_garage_tab,
        'cp_garage' => $cp_garage_tab,
        'ville_garage' => $ville_garage_tab,
        'tel_garage' => $tel_garage_tab
    );
}   
echo json_encode(array($result)); 

