<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercheFiche.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["numero_client"])){
        $numero_client = $_POST['numero_client'];
        $Recherchefiche = getRecherchefiche($numero_client);

    }
}
include "$racine/vue/RechercheFiche.php";
?>