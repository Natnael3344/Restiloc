

<?php 



    $nom_cabinet = $_POST['nom_cabinet'];
    $adresse_cabinet = $_POST['adresse_cabinet'];
    $cp_cabinet = $_POST['cp_cabinet'];
    $ville_cabinet = $_POST['ville_cabinet'];
    $tel_cabinet = $_POST['tel_cabinet'];



    //lien vers la bdd
    $lien = connect_to_db();


    //Requette pour insert d'un nouveau client dans la bdd

    $stmt = $lien->prepare('INSERT INTO cabinet_expertise (nom_cabinet,adresse_cabinet,cp_cabinet,ville_cabinet,tel_cabinet) VALUES (:nom_cabinet,:adresse_cabinet,:cp_cabinet,:ville_cabinet,:tel_cabinet)');
    $stmt->bindValue(':nom_cabinet',$nom_cabinet,PDO::PARAM_STR);
    $stmt->bindValue(':adresse_cabinet',$adresse_cabinet,PDO::PARAM_STR);
    $stmt->bindValue(':cp_cabinet',$cp_cabinet,PDO::PARAM_STR);
    $stmt->bindValue(':ville_cabinet',$ville_cabinet,PDO::PARAM_STR);
    $stmt->bindValue('tel_cabinet',$tel_cabinet,PDO::PARAM_STR);

    $stmt->execute();


?>