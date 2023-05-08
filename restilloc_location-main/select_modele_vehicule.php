
<?php



//requette pour recuperer les nom des client
$stmt = $lien->prepare('SELECT nom_modele FROM modele');

$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $modele_select = $enregistrement['nom_modele'];

    echo("<option>".$modele_select."</option>");
}


?>