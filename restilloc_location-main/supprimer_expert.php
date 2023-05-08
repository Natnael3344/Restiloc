

<?php

if (isset($_POST['oui'])) {

    
    $lien = connect_to_db();

    $stmt = $lien->prepare('DELETE FROM expert WHERE id_expert =:id_expert');
    $stmt->bindValue(':id_expert', $_POST['id_expert'], PDO::PARAM_INT);
    $stmt->execute();
    echo ('<div class="alert alert-success" role="alert">Suppression avec succès !</div>');

}else{
    $id_expert = $_GET['id'];
?>

<form action='./index.php?page=supprimer_expert' method="post">
<div class="row" style="text-align: center;">
    <div class="col-12">
        <h3><strong>Etes-vous sûr de vouloir supprimer cet(te) expert(e)?</strong></h3>
    </div>
    <div class="col-12">
        <input type="hidden" name="id_expert" value="<?php echo $id_expert; ?>"/>
        <input class="btn btn-danger" type="submit" name="oui" value="oui">
        <a class="btn btn-outline-success" type="button" href="./index.php?page=liste_expert" name="non">non</a>
    </div>
</div>
</form>

<?php
}
?>