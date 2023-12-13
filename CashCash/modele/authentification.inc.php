<?php

include_once "bd.utilisateur.inc.php";

function login($matriculeU, $mdpU) {
    if (!isset($_SESSION)) {
        session_start();
    }

    $util = getUtilisateurByMatriculeU($matriculeU);
    $mdpBD = $util["MotDePasse"]; // Utilisez le nom correct du champ dans la base de données

    if (trim($mdpBD) == trim(crypt($mdpU, $mdpBD))) {
        // le mot de passe est celui de l'utilisateur dans la base de donnees
        $_SESSION["matriculeU"] = $matriculeU; // Utilisez la même clé que dans les autres fonctions
        $_SESSION["mdpU"] = $mdpBD; // Utilisez la même clé que dans les autres fonctions
    }

    $role = getRole($matriculeU);

    if ($role == 'technicien') {
        $_SESSION["role"] = 'technicien';
    } elseif ($role == 'assistant') {
        $_SESSION["role"] = 'assistant';
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
        $util = getUtilisateurByMailU($_SESSION["matriculeU"]);
        if ($util["matriculeU"] == $_SESSION["matriculeU"] && $util["mdpU"] == $_SESSION["mdpU"]
        ) {
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