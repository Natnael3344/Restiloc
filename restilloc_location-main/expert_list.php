
<?php
include('connexion_bdd.php');
$lien = connect_to_db();

//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('SELECT * FROM expert');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = array(); 

foreach($rows as $enregistrement) {

    if (isset($enregistrement['id_expert'])) {
        $id_expert_tab = $enregistrement['id_expert'];
    } else {
        $id_expert_tab = "";
    }
    if (isset($enregistrement['nom_expert'])) {
        $nom_expert_tab = $enregistrement['nom_expert'];
    } else {
        $nom_expert_tab = "";
    }
    if (isset($enregistrement['prenom_expert'])) {
        $prenom_expert_tab = $enregistrement['prenom_expert'];
    } else {
        $prenom_expert_tab = "";
    }
    if (isset($enregistrement['tel_expert'])) {
        $tel_expert_tab = $enregistrement['tel_expert'];
    } else {
        $tel_expert_tab = "";
    }
    if (isset($enregistrement['mail_expert'])) {
        $mail_expert_tab = $enregistrement['mail_expert'];
    } else {
        $mail_expert_tab = "";
    }
    $result = array(
        'id_expert' => $id_expert_tab,
        'nom_expert' => $nom_expert_tab,
        'prenom_expert' => $prenom_expert_tab,
        'tel_expert' => $tel_expert_tab,
        'mail_expert' => $mail_expert_tab
    );
}   
echo json_encode(array($result)); 