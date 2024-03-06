<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
VerificationConnexion();

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueAffectationVisite.php";

?>
