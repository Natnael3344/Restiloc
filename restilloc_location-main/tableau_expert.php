
<?php

$lien = connect_to_db();

//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('SELECT * FROM expert');
$stmt->execute();
$rows = $stmt->fetchAll();

foreach($rows as $enregistrement) {
    $id_expert_tab = $enregistrement['id_expert'];
    $nom_expert_tab = $enregistrement['nom_expert'];
    $prenom_expert_tab = $enregistrement['prenom_expert'];
    $tel_expert_tab = $enregistrement['tel_expert'];
    $mail_expert_tab = $enregistrement['mail_expert'];


    
    echo("<tr>
            <th><a href='./index.php?page=modification_expert&id=".$id_expert_tab."'>".$nom_expert_tab."</a></th>
            <th>".$prenom_expert_tab."</th>
            <th>".$tel_expert_tab."</th>
            <th>".$mail_expert_tab."</th>
        </tr>");
}   

?>