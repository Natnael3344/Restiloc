

<?php 


$societe_expert = $_POST['societe_expert'];
$nom_expert = $_POST['nom_expert'];
$prenom_expert = $_POST['prenom_expert'];
$tel_expert = $_POST['tel_expert'];
$mail_expert = $_POST['mail_expert'];

//Requette pour recuperer l'id du cabinet
$stmt = $lien->prepare('SELECT id_cabinet FROM cabinet_expertise WHERE nom_cabinet = :societe_expert');
$stmt->bindValue(':societe_expert',$societe_expert,PDO::PARAM_STR);

$stmt->execute();

$rows = $stmt->fetchAll();


	foreach($rows as $enregistrement){

		$id_cabinet=$enregistrement['id_cabinet'];
	}
//Requette pour insert d'un nouveau véhicule dans la bdd

$stmt = $lien->prepare('INSERT INTO expert (nom_expert,prenom_expert,tel_expert,mail_expert,id_cabinet) VALUES (:nom_expert,:prenom_expert,:tel_expert,:mail_expert,:id_cabinet)');
$stmt->bindValue(':nom_expert',$nom_expert,PDO::PARAM_STR);
$stmt->bindValue(':prenom_expert',$prenom_expert,PDO::PARAM_STR);
$stmt->bindValue(':tel_expert',$tel_expert,PDO::PARAM_STR);
$stmt->bindValue(':mail_expert',$mail_expert,PDO::PARAM_STR);
$stmt->bindValue(':id_cabinet',$id_cabinet,PDO::PARAM_INT);


$stmt->execute();



?>