<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercheFiche.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idnumeroclient = $_POST["numero_client"];
    $modificationclient = getRecherchefiche($idnumeroclient);
    $modificationMateriel = getRecherchemateriel($idnumeroclient);
}

include "$racine/vue/vueModifierFiche.php";
?>
