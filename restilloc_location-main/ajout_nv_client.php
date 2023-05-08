

<?php 

    $erreur="";

    $nom_client = $_POST['nom_client']??"";
    $prenom_client = $_POST['prenom_client']??"";
    $adresse_client = $_POST['adresse_client']??"";
    $cp_client = $_POST['cp_client']??"";
    $ville_client = $_POST['ville_client']??"";
    $tel_client = $_POST['tel_client']??"";
    $portable_client = $_POST['portable_client']??"";
    $email_client = $_POST['mail_client']??"";

    if(mb_strlen($nom_client)<2){
        $erreur="Nom du client trop court";
    }

    if(!is_numeric($tel_client)){
        $erreur="Numéro de télephone incorrect";
    }

    if(strlen($erreur)==0){




    //lien vers la bdd
    $lien = connect_to_db();


    //Requette pour insert d'un nouveau client dans la bdd

    $stmt = $lien->prepare('INSERT INTO client (nom_client,prenom_client,adresse_client,cp_client,ville_client,tel_client,portable_client,email_client) VALUES (:nom_client,:prenom_client,:adresse_client,:cp_client,:ville_client,:tel_client,:portable_client,:email_client)');
    $stmt->bindValue(':nom_client',$nom_client,PDO::PARAM_STR);
    $stmt->bindValue(':prenom_client',$prenom_client,PDO::PARAM_STR);
    $stmt->bindValue(':adresse_client',$adresse_client,PDO::PARAM_STR);
    $stmt->bindValue(':cp_client',$cp_client,PDO::PARAM_STR);
    $stmt->bindValue('ville_client',$ville_client,PDO::PARAM_STR);
    $stmt->bindValue(':tel_client',$tel_client,PDO::PARAM_STR);
    $stmt->bindValue(':portable_client',$portable_client,PDO::PARAM_STR);
    $stmt->bindValue(':email_client',$email_client,PDO::PARAM_STR);

    $stmt->execute();

    }




?>