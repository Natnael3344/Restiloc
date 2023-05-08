<?php
 
    $host = "localhost";
    $user = "root";
    $password = "";
    $bdd = "restilloc";



    function connect_to_db(){
        global  $host, $user, $password, $bdd;
            try
            {
                $host_db_charset = 'mysql:host='.$host.';dbname='.$bdd.';charset=UTF8';
                $pdo_bdd = new PDO($host_db_charset, $user, $password);
            }
            catch (Exception $e)
            {
                die('Erreur : ' .$e->getMessage());
            }
			
        return $pdo_bdd;
    }



    function close_db($pdo_bdd){
        
        $pdo_bdd= null;

    }

?>
