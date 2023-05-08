

<?php 



$nom_garage = $_POST['nom_garage'];
$adresse_garage = $_POST['adresse_garage'];
$cp_garage = $_POST['cp_garage'];
$ville_garage = $_POST['ville_garage'];
$tel_garage = $_POST['tel_garage'];




//lien vers la bdd
$lien = connect_to_db();


//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('INSERT INTO garage (nom_garage,adresse_garage,cp_garage,ville_garage,tel_garage) VALUES (:nom_garage,:adresse_garage,:cp_garage,:ville_garage,:tel_garage)');
$stmt->bindValue(':nom_garage',$nom_garage,PDO::PARAM_STR);
$stmt->bindValue(':adresse_garage',$adresse_garage,PDO::PARAM_STR);
$stmt->bindValue(':cp_garage',$cp_garage,PDO::PARAM_STR);
$stmt->bindValue(':ville_garage',$ville_garage,PDO::PARAM_STR);
$stmt->bindValue(':tel_garage',$tel_garage,PDO::PARAM_STR);

$stmt->execute();



?>