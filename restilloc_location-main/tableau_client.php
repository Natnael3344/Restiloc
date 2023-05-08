
<?php


    $lien = connect_to_db();

    
    //Requette pour insert d'un nouveau véhicule dans la bdd

    $stmt = $lien->prepare('SELECT * FROM client');
    $stmt->execute();
    $rows = $stmt->fetchAll();

    foreach($rows as $enregistrement) {

        $id_client_tab = $enregistrement['id_client'];
        $nom_client_tab = $enregistrement['nom_client'];
        $prenom_client_tab = $enregistrement['prenom_client'];
        $adresse_client_tab = $enregistrement['adresse_client'];
        $cp_client_tab = $enregistrement['cp_client'];
        $ville_client_tab = $enregistrement['ville_client'];
        $tel_client_tab = $enregistrement['tel_client'];
        $portable_client_tab = $enregistrement['portable_client'];
        $email_client_tab = $enregistrement['email_client'];


            echo("<tr>
                    <th><a href='./index.php?page=modification_client&id=".$id_client_tab."'>".$nom_client_tab."</a></th>
                    <th>".$prenom_client_tab."</th>
                    <th>".$adresse_client_tab."</th>
                    <th>".$cp_client_tab."</th>
                    <th>".$ville_client_tab."</th>
                    <th>".$tel_client_tab."</th>
                    <th>".$portable_client_tab."</th>
                    <th>".$email_client_tab."</th>
                </tr>");
    }
          

?>