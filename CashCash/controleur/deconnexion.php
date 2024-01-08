<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/authentification.inc.php";

// Déconnexion de l'utilisateur
logout();

// Redirection vers la page de connexion
include "$racine/vue/vueAuthentification.php";

?>
