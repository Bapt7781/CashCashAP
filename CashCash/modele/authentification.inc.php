<?php

// Inclut le fichier contenant les fonctions de gestion des utilisateurs dans la base de données
include_once "bd.utilisateur.inc.php";

// Fonction de connexion
function login($matriculeU, $mdpU) {
    // Vérifie si la session n'est pas déjà démarrée, si non, la démarre
    if (!isset($_SESSION)) {
        session_start();
    }

    // Récupère les informations de l'utilisateur à partir de la base de données
    $utilisateur = getUtilisateurByMatriculeU($matriculeU);

    // Vérifie si l'utilisateur existe dans la base de données
    if ($utilisateur === false) {
        return null; // L'utilisateur n'existe pas
    }

    // Récupère le mot de passe haché de l'utilisateur depuis la base de données
    $mdpBD = $utilisateur["MotDePasse"];
    // Hache le mot de passe fourni par l'utilisateur
    $mdpUHache = hash('sha256', $mdpU);

    // Vérification du mot de passe
    if (trim($mdpBD) == trim($mdpUHache)) {
        // Si les mots de passe correspondent, initialise les variables de session
        $_SESSION["matriculeU"] = $matriculeU;
        $_SESSION["mdpU"] = $mdpBD;
    }
    else {
        // Si les mots de passe ne correspondent pas, affiche un message d'erreur et redirige vers la page de connexion
        echo '<script>';
        echo 'alert("Échec de la connexion. Vérifiez si les données entrées sont correctes");';
        echo 'window.location.href="?action=connexion";';
        echo '</script>';
    }

    // Récupération du rôle de l'utilisateur
    $role = getRole($matriculeU);

    // Stockage du rôle dans la session
    if ($role == 'technicien' || $role == 'assistant') {
        $_SESSION["role"] = $role;
    }
}

// Fonction de déconnexion
function logout() {
    // Vérifie si la session n'est pas déjà démarrée, si non, la démarre
    if (!isset($_SESSION)) {
        session_start();
    }

    // Supprime les variables de session liées à l'utilisateur
    unset($_SESSION["matriculeU"]);
    unset($_SESSION["mdpU"]);

    // Détruit complètement la session
    session_unset();
    session_destroy();
}

// Fonction pour récupérer le matricule de l'utilisateur connecté
function getMatriculeULoggedOn(){
    if (isLoggedOn()){
        $ret = $_SESSION["matriculeU"];
    }
    else {
        $ret = "";
    }
    return $ret;
}

// Fonction pour vérifier si un utilisateur est connecté
function isLoggedOn() {
    // Vérifie si la session n'est pas déjà démarrée, si non, la démarre
    if (!isset($_SESSION)) {
        session_start();
    }

    $ret = false;

    // Vérifie si les variables de session liées à l'utilisateur sont définies et valides
    if (isset($_SESSION["matriculeU"])) {
        $util = getUtilisateurByMatriculeU($_SESSION["matriculeU"]);
        if ($util["Matricule"] == $_SESSION["matriculeU"] && $util["MotDePasse"] == $_SESSION["mdpU"]) {
            $ret = true;
        }
    }
    return $ret;
}

// Programme principal de test
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Entête de test pour affichage en texte brut
    header('Content-Type:text/plain');

    // Test de connexion
    login("test@bts.sio", "sio");
    if (isLoggedOn()) {
        echo "logged"; // Utilisateur connecté
    } else {
        echo "not logged"; // Utilisateur non connecté
    }

    // Déconnexion
    logout();
}
?>

