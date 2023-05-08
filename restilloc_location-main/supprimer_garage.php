

<?php

if (isset($_POST['oui'])) {


    $lien = connect_to_db();

    $stmt = $lien->prepare('DELETE FROM garage WHERE id_garage =:id_garage');
    $stmt->bindValue(':id_garage', $_POST['id_garage'], PDO::PARAM_INT);
    $stmt->execute();
    echo ('<div class="alert alert-success" role="alert">Suppression avec succès !</div>');

}else{
    $id_garage = $_GET['id'];

?>

<form action='./index.php?page=supprimer_garage' method="post">
<div class="row" style="text-align: center;">
    <div class="col-12">
        <h3><strong>Etes-vous sûr de vouloir supprimer ce garage ?</strong></h3>
    </div>
    <div class="col-12">
        <input type="hidden" name="id_garage" value="<?php echo $id_garage; ?>"/>
        <input class="btn btn-danger" type="submit" name="oui" value="oui">
        <a class="btn btn-outline-success" type="button" href="./index.php?page=liste_garage" name="non">non</a>
    </div>
</div>
</form>

<?php
}
?>