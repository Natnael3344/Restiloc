

<?php

if (isset($_POST['oui'])) {


    $lien = connect_to_db();

    $stmt = $lien->prepare('DELETE FROM vehicule WHERE id_vehicule =:id_vehicule');
    $stmt->bindValue(':id_vehicule', $_POST['id_vehicule'], PDO::PARAM_INT);
    $stmt->execute();
    echo ('<div class="alert alert-success" role="alert">Suppression avec succès !</div>');

}else{
    $id_vehicule = $_GET['id'];

?>

<form action='./index.php?page=supprimer_vehicule' method="post">
<div class="row" style="text-align: center;">
    <div class="col-12">
        <h3><strong>Etes-vous sûr de vouloir supprimer ce véhicule ?</strong></h3>
    </div>
    <div class="col-12">
        <input type="hidden" name="id_vehicule" value="<?php echo $id_vehicule; ?>"/>
        <input class="btn btn-danger" type="submit" name="oui" value="oui">
        <a class="btn btn-outline-success" type="button" href="./index.php?page=liste_vehicule" name="non">non</a>
    </div>
</div>
</form>

<?php
}
?>