
<?php


//requette pour recuperer les nom des client
$stmt = $lien->prepare('SELECT * FROM garage');

$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $nom_garage = $enregistrement['garage'];

    echo("<option>".$nom_garage."</option>");
}


?>