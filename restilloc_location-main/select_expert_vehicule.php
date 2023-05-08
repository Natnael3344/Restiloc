


<?php


//requette pour recuperer les nom des client
$stmt = $lien->prepare('SELECT nom_expert,prenom_expert FROM expert');

$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $nom_expert_select = $enregistrement['nom_expert'];
    $prenom_expert_select = $enregistrement['prenom_expert'];

    echo("<option>".$nom_cabinet_select." ".$prenom_expert_select."</option>");
}


?>