<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercherInterventionAssistant.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idIntervention = $_POST["numero_intervention"];
    $modification = getInformationIntervention($idIntervention);
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueModifierIntervention.php";
?>
