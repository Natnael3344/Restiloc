<?php


    //lien vers la bdd
    $lien = connect_to_db();

?>




    <div class="row">
        <div class="col-4"></div>



        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="rdv_fieldset">
                    <legend class="rdv_legend">Rendrez-vous de restitution</legend>
                    
                    <label for="resti_client" class="label_rdv_restitution">Client</label><br>
                    <select name="resti_client" id="resti_client" class="select_rdv_restitution">
                        <option>-- Sélectionner le client --</option>
                        <?php include('./select_client_vehicule.php'); ?>
                    </select><br>
                    
                    <label for="resti_vehicule" class="label_rdv_restitution">Véhicule</label><br>
                    <select name="resti_vehicule" id="resti_vehicule" class="select_rdv_restitution">
                        <option>-- Sélectionner le véhicule --</option>
                        <?php include('./select_modele_vehicule.php'); ?>
                    </select><br>

                    <label for="resti_expert" class="label_rdv_restitution">Expert</label><br>
                    <select name="resti_expert" id="resti_expert" class="select_rdv_restitution">
                        <option>-- Sélectionner l'expert --</option>
                        <?php include('./select_societe_expert.php'); ?>
                    </select><br>

                    <label for="resti_lieu_rdv" class="label_rdv_restitution">Lieu de RDV</label><br>
                    <select name="resti_lieu_rdv" id="resti_lieu_rdv" class="select_rdv_restitution">
                        <option>-- Sélectionner le garage --</option>
                        <?php include('./select_lieu_rdv.php'); ?>
                    </select><br>

                    <label for="resti_date" class="label_rdv_restitution">Date de mise en circulation</label><br>
                    <input type="datetime-local" id="resti_date" class="input_rdv_restitution" name="resti_date" placeholder="jj/mm/aaaa"><br><br>

                </fieldset>

                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer le rendez-vous">
            </form>
        </div>



        <div class="col-3"></div>
    </div>