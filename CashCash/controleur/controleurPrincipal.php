<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["authentification"] = "connexion.php";
    $lesActions["RechercherIntervention"] = "RechercherIntervention.php";
    $lesActions["Statistiques"] = "Outils.php";
    

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
}

?>

