<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercheFiche.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idnumeroclient = $_POST["numero_client"];
    $modificationclient = getRecherchefiche($numero_client);
    $modificationMateriel = getRecherchemateriel($numero_client);
}

include "$racine/vue/vueModifierFiche.php";
?>
