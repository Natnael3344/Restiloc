




    <div class="row">
        <div class="col-4"></div>



        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="garage_fieldset">
                    <legend class="garage_legend">Garage</legend>
                    
                    <label for="nom_garage" class="label_garage">Nom du garage</label><br>
                    <input type="text" id="nom_garage" class="input_garage" name="nom_garage" placeholder="Nom"><br>
                    
                    <label for="adresse_garage" class="label_garage">Adresse</label><br>
                    <input type="text" id="adresse_garage" class="input_style_adresse_garage_DO input_garage" name="adresse_garage" placeholder="N* et rue"><br>
                    <input type="text" id="cp_garage" class="input_style_cp_garage_DO input_garage" name="cp_garage" placeholder="CP">
                    <input type="text" id="ville_garage" name="ville_garage" placeholder="Ville"><br>

                    <label for="tel_garage" class="label_garage">Télephone</label><br>
                    <input type="text" id="tel_garage" class="input_garage" name="tel_garage" placeholder="Télephone"><br><br>

                </fieldset>

                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer le nouveau garage">
            </form>
        </div>



        <div class="col-3"></div>
    </div>


<?php

    //condition à l'enregistrement

    if(isset($_POST['submit'])){

        include('./ajout_nv_garage.php');
        echo('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');

    }



?>