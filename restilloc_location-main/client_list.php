<?php

include('connexion_bdd.php');
$lien = connect_to_db();

    
    //Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('SELECT * FROM client');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = array(); 

foreach($rows as $enregistrement) {

    if (isset($enregistrement['id_client'])) {
        $id_client_tab = $enregistrement['id_client'];
    } else {
        $id_client_tab = "";
    }
    if (isset($enregistrement['nom_client'])) {
        $nom_client_tab = $enregistrement['nom_client'];
    } else {
        $nom_client_tab = "";
    }
    if (isset($enregistrement['prenom_client'])) {
        $prenom_client_tab = $enregistrement['prenom_client'];
    } else {
        $prenom_client_tab = "";
    }
        
    if (isset($enregistrement['adresse_client'])) {
        $adresse_client_tab = $enregistrement['adresse_client'];
    } else {
        $adresse_client_tab = "";
    }
        
    if (isset($enregistrement['cp_client'])) {
        $cp_client_tab = $enregistrement['cp_client'];
    } else {
        $cp_client_tab = "";
    }
    if (isset($enregistrement['ville_client'])) {
        $ville_client_tab = $enregistrement['ville_client'];
    } else {
        $ville_client_tab = "";
    }
    if (isset($enregistrement['tel_client'])) {
        $tel_client_tab = $enregistrement['tel_client'];
    } else {
        $tel_client_tab = "";
    }
    if (isset($enregistrement['portable_client'])) {
        $portable_client_tab = $enregistrement['portable_client'];
    } else {
        $portable_client_tab = "";
    }
    if (isset($enregistrement['email_client'])) {
        $email_client_tab = $enregistrement['email_client'];
    } else {
        $email_client_tab = "";
    }
        

    $result = array(
        'id_client' => $id_client_tab,
        'nom_client' => $nom_client_tab,
        'prenom_client' => $prenom_client_tab,
        'adresse_client' => $adresse_client_tab,
        'cp_client' => $cp_client_tab,
        'ville_client' => $ville_client_tab,
        'tel_client' => $tel_client_tab,
        'portable_client' => $portable_client_tab,
        'email_client' => $email_client_tab
    );
           
    }
echo json_encode(array($result)); 