
<?php

//include de la page connexion à la bdd
include('./connexion_bdd.php');

//lien vers la bdd
$lien = connect_to_db();

?>




    <div class="row">
        <div class="col-4"></div>



        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="expert_fieldset">
                    <legend class="expert_legend">Experts</legend>
                    
                    <label for="societe_expert" class="label_expert">Société</label><br>
                    <select name="societe_expert" id="societe_expert" class="select_expert">
                        <option>-- Choisir la société d'un expert --</option>
                        <?php include('./select_societe_expert.php'); ?>
                    </select><br>
                    
                    <label for="nom_expert" class="label_expert">Nom</label><br>
                    <input type="text" id="nom_expert" class="input_expert" name="nom_expert" placeholder="Nom"><br>

                    <label for="prenom_expert" class="label_expert">Prénom</label><br>
                    <input type="text" id="prenom_expert" class="input_expert" name="prenom_expert" placeholder="Prenom"><br>
                    
                    <label for="tel_expert" class="label_expert">Télephone</label><br>
                    <input type="text" id="tel_expert" class="input_expert" name="tel_expert" placeholder="Telephone"><br>
                    
                    <label for="mail_expert" class="label_expert">Email</label><br>
                    <input type="email" id="mail_expert" class="input_expert input_style_expert_DO" name="mail_expert" placeholder="Email"><br><br>

                </fieldset>

                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer un nouvelle expert">
            </form>
        </div>



        <div class="col-3"></div>
    </div>


<?php

    //condition à l'enregistrement

    if(isset($_POST['submit'])){

        include('./ajout_nv_expert.php');
        echo('<div class="alert alert-success" role="alert">Enregistrement avec succès !</div>');

    }



?>