<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueAffectationVisite.php";

?>
