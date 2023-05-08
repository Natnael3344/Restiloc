<?php


if (isset($_POST['modifier'])) {

    $lien = connect_to_db();

    $stmt = $lien->prepare('UPDATE client SET nom_client = :nom_client, prenom_client = :prenom_client, adresse_client = :adresse_client, cp_client=:cp_client, ville_client= :ville_client, tel_client= :tel_client, portable_client=:portable_client, mail_client = :mail_client WHERE id_client =:id_client');
    $stmt->bindValue(':nom_client', $_POST['nom_client'], PDO::PARAM_STR);
    $stmt->bindValue(':prenom_client', $_POST['prenom_client'], PDO::PARAM_STR);
    $stmt->bindValue(':adresse_client', $_POST['adresse_client'], PDO::PARAM_STR);
    $stmt->bindValue(':cp_client', $_POST['cp_client'], PDO::PARAM_STR);
    $stmt->bindValue(':ville_client', $_POST['ville_client'], PDO::PARAM_STR);
    $stmt->bindValue(':tel_client', $_POST['tel_client'], PDO::PARAM_STR);
    $stmt->bindValue(':portable_client', $_POST['portable_client'], PDO::PARAM_STR);
    $stmt->bindValue(':email_client', $_POST['email_client'], PDO::PARAM_STR);
    $stmt->bindValue(':id_client', $_POST['id_client'], PDO::PARAM_INT);
    $stmt->execute();

    echo "<pre>";
    print_r($stmt);
    print_r($_POST);
    echo"</pre>";

    $erreur="";

    if (strlen($erreur) == 0) {
        echo ('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');
    } else {
        echo ('<div class="col-12">' . $erreur . '</div>');
    }
} else {
    

    $id_client = $_GET['id'];
    $lien = connect_to_db();

    //requette pour recuperer les nom des client
    $stmt = $lien->prepare('SELECT * FROM client WHERE id_client = :id_client');
    $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    foreach ($rows as $enregistrement) {
        $nom_client_select = $enregistrement['nom_client'];
        $prenom_client_select = $enregistrement['prenom_client'];
        $adresse_client_select = $enregistrement['adresse_client'];
        $cp_client_select = $enregistrement['cp_client'];
        $ville_client_select = $enregistrement['ville_client'];
        $tel_client_select = $enregistrement['tel_client'];
        $portable_client_select = $enregistrement['portable_client'];
        $email_client_select = $enregistrement['email_client'];

    }

?>



    <form action="./index.php?page=modification_client" method="post">
        <div class="row" style="text-align: center;">
            <div class="col-12">
                <h3>Modification du client:</h3>
            </div>

            <div class="row">
                <div class="col-12">
                    <label>Nom:</label>
                    <input type="text" name="nom_client" value="<?php echo $nom_client_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Prénom:</label>
                    <input type="text" name="prenom_client" value="<?php echo $prenom_client_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Adresse:</label>
                    <input type="text" name="adresse_client" value="<?php echo $adresse_client_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Code postal:</label>
                    <input type="text" name="cp_client" value="<?php echo $cp_client_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Ville:</label>
                    <input type="text" name="ville_client" value="<?php echo $ville_client_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Télephone:</label>
                    <input type="text" name="tel_client" value="<?php echo $tel_client_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Portable:</label>
                    <input type="text" name="portable_client" value="<?php echo $portable_client_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Email:</label>
                    <input type="mail" name="email_client" value="<?php echo $email_client_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <input type="hidden" name="id_client" value="<?php echo $id_client; ?>"/>
                    <input class="btn btn-outline-success" type="submit" name="modifier" value="Modifier">
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12" style="text-align: center;">
        <a class="btn btn-danger" type="button" href='./index.php?page=supprimer_client&id=<?php echo $id_client; ?>' name="supprimer" >supprimer</a>
        </div>
    </div>
<?php

}

?>