<?php

include_once "bd.utilisateur.inc.php";

function login($matriculeU, $mdpU) {
    if (!isset($_SESSION)) {
        session_start();
    }

    $utilisateur = getUtilisateurByMatriculeU($matriculeU);
    if ($utilisateur === false) {
        return null; // L'utilisateur n'existe pas
    }

    $mdpBD = $utilisateur["MotDePasse"];

    // Vérification du mot de passe
    if (trim($mdpBD) == trim($mdpU)) {
        $_SESSION["matriculeU"] = $matriculeU;
        $_SESSION["mdpU"] = $mdpBD;
    }
    // Récupération du rôle
    $role = getRole($matriculeU);

    // Stockage du rôle dans la session
    if ($role == 'technicien' || $role == 'assistant') {
        $_SESSION["role"] = $role;
    }
}



function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }

    // Ajouter un message de débogage pour confirmer le début de la fonction
    error_log("Début de la fonction logout");

    // Supprimer les variables de session
    unset($_SESSION["matriculeU"]);
    unset($_SESSION["mdpU"]);

    // Ajouter un message de débogage pour confirmer la suppression des variables de session
    error_log("Variables de session supprimées");

    // détruire la session complètement
    session_unset();
    session_destroy();

    // Ajouter un message de débogage pour confirmer la fin de la fonction
    error_log("Fin de la fonction logout");

}



function getMatriculeULoggedOn(){
    if (isLoggedOn()){
        $ret = $_SESSION["matriculeU"];
    }
    else {
        $ret = "";
    }
    return $ret;
        
}

function isLoggedOn() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $ret = false;

    if (isset($_SESSION["matriculeU"])) {
        $util = getUtilisateurByMatriculeU($_SESSION["matriculeU"]);
        if ($util["Matricule"] == $_SESSION["matriculeU"] && $util["MotDePasse"] == $_SESSION["mdpU"]) {
            $ret = true;
        }
    }
    return $ret;

}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');


    // test de connexion
    login("test@bts.sio", "sio");
    if (isLoggedOn()) {
        echo "logged";
    } else {
        echo "not logged";
    }

    // deconnexion
    logout();
}
?>