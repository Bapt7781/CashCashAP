<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.OutilsStatistiques.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["NomEmploye"])){
        $employe = $_POST["NomEmploye"];
    }
}
?>