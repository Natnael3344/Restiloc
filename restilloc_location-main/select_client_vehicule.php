
<?php



    //requette pour recuperer les nom des client
    $stmt = $lien->prepare('SELECT nom_client,prenom_client FROM client');

    $stmt->execute();
    $rows = $stmt->fetchAll();

    foreach($rows as $enregistrement) {
        $nom_client_select = $enregistrement['nom_client'];
        $prenom_client_select = $enregistrement['prenom_client'];

        echo("<option>".$nom_client_select." ".$prenom_client_select."</option>");
    }


?>