

<?php



    //lien vers la bdd
    $lien = connect_to_db();

?>



    <div class="row">
        <div class="col-4"></div>



        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="vehicule_fieldset">
                    <legend class="vehicule_legend">Véhicule</legend>
                    
                    <label class="label_nv_vehicule" for="client_locataire">Client locataire</label><br>
                    <select class="select_nv_vehicule" name="client_locataire" id="client_locataire">
                        <option>-- Sélectionner le client --</option>
                        <?php include('./select_client_vehicule.php'); ?>
                    </select><br>

                    <label class="label_nv_vehicule" for="immatriculation_client">Immatriculation</label><br>
                    <input class="input_nv_vehicule" type="text" id="immatriculation_client" name="immatriculation_client" placeholder="Immatriculation"><br>
                    
                    <label class="label_nv_vehicule" for="motorisation">Motorisation</label><br>
                    <select class="select_nv_vehicule" name="motorisation" id="motorisation">
                        <option>-- Choisir une motorisation --</option>
                        <?php  include('./select_motorisation_vehicule.php'); ?>
                    </select><br>

                    <label class="label_nv_vehicule" for="marque">Marque</label><br>
                    <select class="select_nv_vehicule" name="marque" id="marque" onchange="select_marque();">
                        <option>-- Choisir une marque --</option>
                        <?php include('./select_marque_vehicule.php'); ?>
                    </select><br>

                    <label class="label_nv_vehicule" for="modele">Modèle</label><br>
                    <select class="select_nv_vehicule" name="modele" id="modele">
                        <option>-- Choisir un modèle --</option>
                        <?php include('./select_modele_vehicule.php'); ?>
                    </select><br>

                    <label class="label_nv_vehicule" for="date_circulation">Date de mise en circulation</label><br>
                    <input class="input_nv_vehicule" type="text" id="date_circulation" name="date_circulation" placeholder="jj/mm/aaaa"><br><br>

                </fieldset>

                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer le nouveau véhicule">
            </form>
        </div>



        <div class="col-3"></div>
    </div>


<?php

    //condition à l'enregistrement

    if(isset($_POST['submit'])){

    include('./ajout_nv_vehicule.php');
    echo('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');

    }



?>