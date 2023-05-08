
<?php


//requette pour recuperer les nom des client
$stmt = $lien->prepare('SELECT nom_marque FROM marque');

$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $marque_select = $enregistrement['nom_marque'];

    echo("<option>".$marque_select."</option>");
}


?>