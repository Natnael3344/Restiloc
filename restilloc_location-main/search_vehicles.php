<?php

include('connexion_bdd.php');

if(isset($_POST['search'])) {
    $search_query = $_POST['search'];

    $lien = connect_to_db();
    $stmt = $lien->prepare("SELECT vehicule.immatriculation, vehicule.motorisation, vehicule.date_circulation, client.nom_client, client.prenom_client, client.adresse_client, client.cp_client, client.ville_client, client.tel_client, client.email_client, client.portable_client 
    FROM vehicule 
    JOIN client ON vehicule.id_client = client.id_client
    WHERE vehicule.immatriculation = :search_query");
    $stmt->bindParam(':search_query', $search_query);
    $stmt->execute();

    $rows = $stmt->fetchAll();

    $result = array();  // create an empty array to hold the response
    foreach($rows as $enregistrement) {
        if (isset($enregistrement['id_vehicule'])) {
            $id_vehicule_tab = $enregistrement['id_vehicule'];
        } else {
            $id_vehicule_tab = "";
        }
        if (isset($enregistrement['immatriculation'])) {
            $imatriculation_tab = $enregistrement['immatriculation'];
        } else {
            $imatriculation_tab = "";
        }
        if (isset($enregistrement['motorisation'])) {
            $motorisation_tab = $enregistrement['motorisation'];
        } else {
            $motorisation_tab = "";
        }
        if (isset($enregistrement['date_circulation'])) {
            $date_circulation_tab = $enregistrement['date_circulation'];
        } else {
            $date_circulation_tab = "";
        }
        if (isset($enregistrement['id_client'])) {
            $id_client_tab = $enregistrement['id_client'];
        } else {
            $id_client_tab = "";
        }
        if (isset($enregistrement['id_modele'])) {
            $id_modele_tab = $enregistrement['id_modele'];
        } else {
            $id_modele_tab = "";
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
        if (isset($enregistrement['portable_client'])) {
            $portable_client_tab = $enregistrement['portable_client'];
        } else {
            $portable_client_tab = "";
        }

        $result = array(
            'immatriculation' => $imatriculation_tab,
            'motorisation' => $motorisation_tab,
            'date_circulation' => $date_circulation_tab,
            'id_client' => $id_client_tab,
            'id_modele' => $id_modele_tab,
            'nom_client' => $nom_client_tab,
            'prenom_client' => $prenom_client_tab,
            'adresse_client' => $adresse_client_tab,
            'cp_client' => $cp_client_tab,
            'ville_client' => $ville_client_tab,
            'portable_client' => $portable_client_tab
        );
    }

    echo json_encode($result);  // encode the result as JSON and output it
}
