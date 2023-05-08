




    <div class="row">
        <div class="col-4"></div>



        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="cabinet_expert_fieldset">
                    <legend class="cabinet_expert_legend">Cabinet d'expertise</legend>
                    
                    
                    <label for="nom_cabinet" class="label_cabinet">Société</label><br>
                    <input type="text" id="nom_cabinet" class="input_cabinet" name="nom_cabinet" placeholder="Nom du cabinet d'expertise"><br>
                    
                    <label for="adresse_cabinet" class="label_cabinet">Adresse</label><br>
                    <input type="text" id="adresse_cabinet" class="input_style_adresse_cabinet_DO input_cabinet" name="adresse_cabinet" placeholder="N* et rue"><br>
                    <input type="text" id="cp_cabinet" class="input_style_cp_cabinet_DO input_cabinet" name="cp_cabinet" placeholder="CP">
                    <input type="text" id="ville_cabinet" name="ville_cabinet" placeholder="Ville"><br>
                    
                    <label for="tel_cabinet" class="label_cabinet">Télephone</label><br>
                    <input type="text" id="tel_cabinet" class="input_cabinet" name="tel_cabinet" placeholder="Telephone"><br><br>

                </fieldset>

                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer un nouveau cabinet d'expertise">
            </form>
        </div>



        <div class="col-3"></div>
    </div>


<?php

    //condition à l'enregistrement

    if(isset($_POST['submit'])){

        include('./ajout_nv_cabinet.php');
        echo('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');

    }



?>