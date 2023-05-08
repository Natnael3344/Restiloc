<?php


if (isset($_POST['modifier'])) {

    $lien = connect_to_db();

    $stmt = $lien->prepare('UPDATE vehicule SET immatriculation = :immatriculation,motorisation = :motorisation,date_circulation = :date_circulation WHERE id_vehicule =:id_vehicule');
    $stmt->bindValue(':immatriculation', $_POST['immatriculation'], PDO::PARAM_STR);
    $stmt->bindValue(':motorisation', $_POST['motorisation'], PDO::PARAM_STR);
    $stmt->bindValue(':date_circulation', $_POST['date_circulation'], PDO::PARAM_STR);
    $stmt->bindValue(':id_vehicule', $_POST['id_vehicule'], PDO::PARAM_INT);
    $stmt->execute();

    $erreur="";

    if (strlen($erreur) == 0) {
        echo ('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');
    } else {
        echo ('<div class="col-12">' . $erreur . '</div>');
    }
}else {
    

    $id_vehicule = $_GET['id'];
    $lien = connect_to_db();

    //requette pour recuperer les nom des client
    $stmt = $lien->prepare('SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule');
    $stmt->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    foreach ($rows as $enregistrement) {
        $imatriculation_tab = $enregistrement['immatriculation'];
        $motorisation_tab = $enregistrement['motorisation'];
        $date_circulation_tab = $enregistrement['date_circulation'];
        $id_client_tab = $enregistrement['id_client'];
        $id_modele_tab = $enregistrement['id_modele'];
    }

?>



    <form action="./index.php?page=modification_vehicule" method="post">
        <div class="row" style="text-align: center;">
            <div class="col-12">
                <h3>Modification du vehicule:</h3>
            </div>

            <div class="row">
                <div class="col-12">
                    <label>immatriculation:</label>
                    <input type="text" name="immatriculation" value="<?php echo $imatriculation_tab; ?>" />
                </div>
                <div class="col-12">
                    <label>motorisation:</label>
                    <input type="text" name="motorisation" value="<?php echo $motorisation_tab; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Date de mise en circulation:</label>
                    <input type="text" name="date_circulation" value="<?php echo $date_circulation_tab; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <input type="hidden" name="id_vehicule" value="<?php echo $id_vehicule; ?>"/>
                    <input class="btn btn-outline-success" type="submit" name="modifier" value="Modifier">
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12" style="text-align: center;">
        <a class="btn btn-danger" type="button" href='./index.php?page=supprimer_vehicule&id=<?php echo $id_vehicule; ?>' name="supprimer" >supprimer</a>
        </div>
    </div>

<?php

}

?>