

<?php

if (isset($_POST['oui'])) {


    $lien = connect_to_db();

    $stmt = $lien->prepare('DELETE FROM client WHERE id_client =:id_client');
    $stmt->bindValue(':id_client', $_POST['id_client'], PDO::PARAM_INT);
    $stmt->execute();
    echo ('<div class="alert alert-success" role="alert">Suppression avec succès !</div>');

}else{
    $id_client = $_GET['id'];
?>

<form action='./index.php?page=supprimer_client' method="post">
<div class="row" style="text-align: center;">
    <div class="col-12">
        <h3><strong>Etes-vous sûr de vouloir supprimer ce(tte) client(e)?</strong></h3>
    </div>
    <div class="col-12">
        <input type="hidden" name="id_client" value="<?php echo $id_client; ?>"/>
        <input class="btn btn-danger" type="submit" name="oui" value="oui">
        <a class="btn btn-outline-success" type="button" href="./index.php?page=liste_expert" name="non">non</a>
    </div>
</div>
</form>

<?php
}
?>