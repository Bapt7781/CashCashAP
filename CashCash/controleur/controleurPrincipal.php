<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["authentification"] = "connexion.php";
    $lesActions["RechercherIntervention"] = "RechercherIntervention.php";
    $lesActions["Statistiques"] = "Outils.php";
    $lesActions["ModifierIntervention"] = "ModifierIntervention.php";
    $lesActions["ValiderInformation"] = "ValiderInformation.php";
    $lesActions["RechercheFiche"] = "Fiche.php";
<<<<<<< HEAD
    $lesActions["ValiderIntervention"] = "validationIntervention.php";    
=======
    $lesActions["AffectationVisite"] = "AffectationVisite.php";
>>>>>>> b61c04d5fc8120dc01b8ba5718705fa6ee69f2bb
    

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
}

?>

