
<?php

    //variable stockant la page par defaut
    $page_a_afficher="accueil";

    //une condition permettant de définir la page par défaut à afficher à l'entrée sur le site
    if( isset($_GET['page']))
    {
            $page_a_afficher = $_GET['page'];

    }
    
    include_once('./connexion_bdd.php');
    
?>

<html>

<head>
    <!--- titre du site -->
    <title> Restiloc </title>
    <!--image de l'onglet---->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ****************************************************************************************************** -->
    <!-- Ces liens sont necessaires pour BootStrap                                                              -->
    <!-- ****************************************************************************************************** -->
    <!-- Lien vers le CSS sur le site Bootsrap-->
    <!--
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    -->
    <!-- Lien vers le CSS Local -->
    <link rel="stylesheet" href="./bootstrap/5.1.2/css/bootstrap.min.css">
    <!-- Mon CSS perso pour inclure les polices de caractères -->
    <link rel="stylesheet" href="./fonts.css">

    <!---- Lien vers Js+Query Local --->
    <link rel="stylesheet" href="./bootstrap/5.1.2/js/jquery-3.6.0.min.js">
    <script src="./bootstrap/5.1.2/js/jquery-3.6.0.js"></script>
    <script  src="test_classes.js" async></script>

    <!-- Lien vers le JS sur le site Bootsrap  (bundle inclut tout ce dont on a besoin)-->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    -->
    <script src="./bootstrap/5.1.2/js/bootstrap.bundle.min.js"></script>
    
    <!--lien vers la feuille de style.css-->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="stylesheet" href="./css/nv_client.css">
    <link rel="stylesheet" href="./css/nv_vehicule.css">
    <link rel="stylesheet" href="./css/rdv_restitution.css">
    <link rel="stylesheet" href="./css/nv_garage.css">
    <link rel="stylesheet" href="./css/nv_expert.css">
    <link rel="stylesheet" href="./css/nv_cabinet_expert.css">
    <link rel="stylesheet" href="./css/liste_clients_vehicules.css">
    <link rel="stylesheet" href="./css/liste_garage.css">






    <!--Liens vers "index.css" pour le responsive de la page sur d'autres écrans-->
    <link rel="stylesheet" media="screen and (max-width: 1280px)" href="index.css" />
    <link rel="stylesheet" media="screen all and (min:width:1024px) and (max-width:1280px)" href="index.css"/>
    <link rel="stylesheet" media="screen all and (orientation:portrait)" href="index.css"/>
    <link rel="stylesheet" media="screen all and (orientation:landscape)" href="inex.css"/>
    <link rel="stylesheet" media="screen all and (min:width:0px) and (max-width:420px)"  href="index.css" />
    

</head>


<body>

<!-- "header" va servir à parametrer le haut de la page-->
<div id="header" class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid ">
            <a class="navbar-brand" href="./index.php?page=accueil">RESTILOC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dossiers clients
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./index.php?page=nv_client">Nouveau client</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=nv_vehicule">Nouveau véhicule</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=liste_clients">Liste des clients</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=liste_vehicule">Liste des vehicules</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dossiers de restitution
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./index.php?page=rdv_restitution">Programmer un RDV de restitution</a></li>
                        <li><a class="dropdown-item" href="#">Afficher le dossier de restitution</a></li>
                        <li><a class="dropdown-item" href="#">Liste des dossiers de restitution</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Experts
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./index.php?page=nv_expert">Ajouter un Expert</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=nv_cabinet_expert">Ajouter un cabinet d'expertise</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=liste_expert">Liste des experts</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Garages
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./index.php?page=nv_garage">Ajouter un garage</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=liste_garage">Liste des garages</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="N* Dossier ou Nom client" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Chercher</button>
            </form>
            </div>
        </div>
    </nav>
</div>


<!-- "content" va servir à parametrer le corps de la page-->
<div id="content" class="row">

    <?php
    //ici dans le body sera la page par defaut à afficher
        include ( $page_a_afficher.".php");
    ?>
        
</div>



<!-- "footer" va servir à parametrer le bas de la page-->
<div id="footer">
    <div class="gauche"><strong>Projet "Restiloc" BTS SIO</strong></div>
    <a href="./mentions_legales/Mensions Legales dev.pdf" target="blank">Mentions légales du site</a>
    <div class="droite">Copyright © 2023 <br> DYLAN OIKNINE -- SIMEON FRIEDRICH -- BETTY GHEORGHITA -- ERIC PAVA</div>
</div>

</div>


</body>
</html>


