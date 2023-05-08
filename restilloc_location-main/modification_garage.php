<?php


if (isset($_POST['modifier'])) {

    $lien = connect_to_db();

    $stmt = $lien->prepare('UPDATE garage SET nom_garage = :nom_garage,adresse_garage = :adresse_garage,cp_garage = :cp_garage,ville_garage = :ville_garage,tel_garage = :tel_garage WHERE id_garage =:id_garage');
    $stmt->bindValue(':nom_garage', $_POST['nom_garage'], PDO::PARAM_STR);
    $stmt->bindValue(':adresse_garage', $_POST['adresse_garage'], PDO::PARAM_STR);
    $stmt->bindValue(':cp_garage', $_POST['cp_garage'], PDO::PARAM_STR);
    $stmt->bindValue(':ville_garage', $_POST['ville_garage'], PDO::PARAM_STR);
    $stmt->bindValue(':tel_garage', $_POST['tel_garage'], PDO::PARAM_STR);
    $stmt->bindValue(':id_garage', $_POST['id_garage'], PDO::PARAM_INT);
    $stmt->execute();

    $erreur="";

    if (strlen($erreur) == 0) {
        echo ('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');
    } else {
        echo ('<div class="col-12">' . $erreur . '</div>');
    }
} else {
    

    $id_garage = $_GET['id'];
    $lien = connect_to_db();

    //requette pour recuperer les nom des client
    $stmt = $lien->prepare('SELECT * FROM garage WHERE id_garage = :id_garage');
    $stmt->bindValue(':id_garage', $id_garage, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    foreach ($rows as $enregistrement) {
        $nom_garage_select = $enregistrement['nom_garage'];
        $adresse_garage_select = $enregistrement['adresse_garage'];
        $cp_garage_select = $enregistrement['cp_garage'];
        $ville_garage_select = $enregistrement['ville_garage'];
        $tel_garage_select = $enregistrement['tel_garage'];
    }

?>



    <form action="./index.php?page=modification_garage" method="post">
        <div class="row" style="text-align: center;">
            <div class="col-12">
                <h3>Modification du garage:</h3>
            </div>

            <div class="row">
                <div class="col-12">
                    <label>Nom:</label>
                    <input type="text" name="nom_garage" value="<?php echo $nom_garage_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Adresse:</label>
                    <input type="text" name="adresse_garage" value="<?php echo $adresse_garage_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Code postal:</label>
                    <input type="text" name="cp_garage" value="<?php echo $cp_garage_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Ville:</label>
                    <input type="text" name="ville_garage" value="<?php echo $ville_garage_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Télephone:</label>
                    <input type="text" name="tel_garage" value="<?php echo $tel_garage_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <input type="hidden" name="id_garage" value="<?php echo $id_garage; ?>"/>
                    <input class="btn btn-outline-success" type="submit" name="modifier" value="Modifier">
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12" style="text-align: center;">
        <a class="btn btn-danger" type="button" href='./index.php?page=supprimer_garage&id=<?php echo $id_garage; ?>' name="supprimer" >supprimer</a>
        </div>
    </div>
<?php

}

?>