<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.AffectationVisite.inc.php";
$visitesNonAffec = getVisitesNonAffec();
$visitesAffec = getVisitesAffec();
// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueAffectationVisite.php";
?>
