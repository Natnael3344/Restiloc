




    <div class="row">
        <div class="col-4"></div>



        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="client_fieldset">
                    <legend class="client_legend">Client</legend>
                    
                    <label for="nom_client" class="label_client">Nom du client</label><br>
                    <input type="text" class="input_client" id="nom_client" name="nom_client" placeholder="Nom" required><br>
                    
                    <label for="prenom_client" class="label_client">Prénom du client</label><br>
                    <input type="text" class="input_client" id="prenom_client" name="prenom_client" placeholder="Prénom" required><br>

                    <label for="adresse_client" class="label_client">Adresse</label><br>
                    <input type="text" class="input_client input_style_client_DO" id="adresse_client" name="adresse_client" placeholder="N* et rue" required><br>
                    <input type="text" class="input_client input_style_cp_client_DO" id="cp_client" name="cp_client" placeholder="CP" required>
                    <input type="text" id="ville_client" name="ville_client" placeholder="Ville" required><br>

                    <label for="tel_client" class="label_client">Télephone</label><br>
                    <input type="text" class="input_client" id="tel_client" name="tel_client" placeholder="N* de télephone" required><br>

                    <label for="portable_client" class="label_client">Portable</label><br>
                    <input type="text" class="input_client" id="portable_client" name="portable_client" placeholder="N* de télephone portable"><br>

                    <label for="mail_client" class="label_client">Email</label><br>
                    <input type="email" class="input_client input_style_client_DO" id="mail_client" name="mail_client" placeholder="Email" required><br><br>

                </fieldset>

                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer le client">
            </form>
        </div>



        <div class="col-3"></div>
    </div>


<?php

    //condition à l'enregistrement

    if(isset($_POST['submit'])){

        include('./ajout_nv_client.php');
        if(strlen($erreur)==0){
            echo('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');
        }else{
            echo('<div class="col-12">'.$erreur.'</div>');
        }
    
    }

?>