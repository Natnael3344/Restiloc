
<?php


$lien = connect_to_db();


//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('SELECT * FROM garage');
$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $id_garage_tab = $enregistrement['id_garage'];
    $nom_garage_tab = $enregistrement['nom_garage'];
    $adresse_garage_tab = $enregistrement['adresse_garage'];
    $cp_garage_tab = $enregistrement['cp_garage'];
    $ville_garage_tab = $enregistrement['ville_garage'];
    $tel_garage_tab = $enregistrement['tel_garage'];



    echo("<tr>
            <th><a href='./index.php?page=modification_garage&id=".$id_garage_tab."'>".$nom_garage_tab."</a></th>
            <th>".$adresse_garage_tab."</th>
            <th>".$cp_garage_tab."</th>
            <th>".$ville_garage_tab."</th>
            <th>".$tel_garage_tab."</th>
        </tr>");
}   

?>