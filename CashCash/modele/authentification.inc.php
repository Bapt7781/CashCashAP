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
        echo "5";
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
    unset($_SESSION["matriculeU"]);
    unset($_SESSION["mdpU"]);
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
?>