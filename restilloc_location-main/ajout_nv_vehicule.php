

<?php 



$client_locataire = $_POST['client_locataire'];
$immatriculation = $_POST['immatriculation_client'];
$motorisation = $_POST['motorisation'];
$date_circulation = $_POST['date_circulation'];




//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('INSERT INTO vehicule (immatriculation,motorisation,date_circulation) VALUES (:immatriculation,:motorisation,:date_circulation)');
$stmt->bindValue(':immatriculation',$immatriculation,PDO::PARAM_STR);
$stmt->bindValue(':motorisation',$motorisation,PDO::PARAM_STR);
$stmt->bindValue(':date_circulation',$date_circulation,PDO::PARAM_STR);

$stmt->execute();



?>