<?php


if (isset($_POST['modifier'])) {

    $lien = connect_to_db();

    $stmt = $lien->prepare('UPDATE expert SET nom_expert = :nom_expert,prenom_expert = :prenom_expert,tel_expert = :tel_expert,mail_expert = :mail_expert WHERE id_expert =:id_expert');
    $stmt->bindValue(':nom_expert', $_POST['nom_expert'], PDO::PARAM_STR);
    $stmt->bindValue(':prenom_expert', $_POST['prenom_expert'], PDO::PARAM_STR);
    $stmt->bindValue(':tel_expert', $_POST['tel_expert'], PDO::PARAM_STR);
    $stmt->bindValue(':mail_expert', $_POST['mail_expert'], PDO::PARAM_STR);
    $stmt->bindValue(':id_expert', $_POST['id_expert'], PDO::PARAM_INT);
    $stmt->execute();

    $erreur="";

    if (strlen($erreur) == 0) {
        echo ('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');
    } else {
        echo ('<div class="col-12">' . $erreur . '</div>');
    }
} else {
    

    $id_expert = $_GET['id'];
    $lien = connect_to_db();

    //requette pour recuperer les nom des client
    $stmt = $lien->prepare('SELECT * FROM expert WHERE id_expert = :id_expert');
    $stmt->bindValue(':id_expert', $id_expert, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    foreach ($rows as $enregistrement) {
        $nom_expert_select = $enregistrement['nom_expert'];
        $prenom_expert_select = $enregistrement['prenom_expert'];
        $tel_expert_select = $enregistrement['tel_expert'];
        $mail_expert_select = $enregistrement['mail_expert'];
    }
}
?>



    <form action="./index.php?page=modification_expert" method="post">
        <div class="row" style="text-align: center;">
            <div class="col-12">
                <h3>Modification de l'expert:</h3>
            </div>

            <div class="row">
                <div class="col-12">
                    <label>Nom:</label>
                    <input type="text" name="nom_expert" value="<?php echo $nom_expert_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Prénom:</label>
                    <input type="text" name="prenom_expert" value="<?php echo $prenom_expert_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Télephone:</label>
                    <input type="text" name="tel_expert" value="<?php echo $tel_expert_select; ?>" />
                </div>
                <div class="col-12">
                    <label>Email:</label>
                    <input type="mail" name="mail_expert" value="<?php echo $mail_expert_select; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <input type="hidden" name="id_expert" value="<?php echo $id_expert; ?>"/>
                    <input class="btn btn-outline-success" type="submit" name="modifier" value="Modifier">
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12" style="text-align: center;">
        <a class="btn btn-danger" type="button" href='./index.php?page=supprimer_expert&id=<?php echo $id_expert; ?>' name="supprimer" >supprimer</a>
        </div>
    </div>
<?php

}

?>