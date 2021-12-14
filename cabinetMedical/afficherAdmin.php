<?php

    if(!isset($_POST['cmdp']) || !isset($_POST['cidentifiant'])){
        echo "remplissez toutes les valeurs";
    }
    $identifiant = $_POST['cidentifiant'];
    $mdp = $_POST['cmdp'];

    echo $identifiant, $mdp;

?>