


<?php


//requette pour recuperer les nom des client
$stmt = $lien->prepare('SELECT nom_cabinet FROM cabinet_expertise');

$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $nom_cabinet_select = $enregistrement['nom_cabinet'];

    echo("<option>".$nom_cabinet_select."</option>");
}


?>