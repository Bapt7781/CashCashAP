<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";

// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["matriculeU"]) && isset($_POST["mdpU"])){
    $matriculeU=$_POST["matriculeU"];
    $mdpU=$_POST["mdpU"];
    echo $matriculeU;
    echo $mdpU;
}
else
{
    $matriculeU="";
    $mdpU="";
}

// traitement si necessaire des donnees recuperees
login($matriculeU,$mdpU);

if (isLoggedOn()){ // si l'utilisateur est connecté on redirige vers la vue accueil
    include "$racine/vue/Accueil.php";
    echo "7";
}
//else{ // l'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    // appel du script de vue 
    $titre = "authentification";
    include "$racine/vue/vueAuthentification.php";
//}