<?php

$lien = connect_to_db();


//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('SELECT * FROM vehicule');
$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $id_vehicule_tab = $enregistrement['id_vehicule'];
    $imatriculation_tab = $enregistrement['immatriculation'];
    $motorisation_tab = $enregistrement['motorisation'];
    $date_circulation_tab = $enregistrement['date_circulation'];
    $id_client_tab = $enregistrement['id_client'];
    $id_modele_tab = $enregistrement['id_modele'];



    echo("<tr>
            <th><a href='./index.php?page=modification_vehicule&id=".$id_vehicule_tab."'>".$imatriculation_tab."</a></th>
            <th>".$motorisation_tab."</th>
            <th>".$date_circulation_tab."</th>
            <th>".$id_client_tab."</th>
            <th>".$id_modele_tab."</th>
        </tr>");
}   

?>