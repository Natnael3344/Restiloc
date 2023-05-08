
<?php


//requette pour recuperer les nom des client
$stmt = $lien->prepare('SELECT nom_motorisation FROM motorisation');

$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $motorisation_select = $enregistrement['nom_motorisation'];

    echo("<option>".$motorisation_select."</option>");
}


?>