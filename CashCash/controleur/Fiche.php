<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.RechercheFiche.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["numclient"])){
        $numero_client = $_POST['numero_client'];

        $Recherchefiche = getRecherchefiche($numclient);
    }
}
include "$racine/vue/RechercheFiche.php";
?>