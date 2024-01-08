<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.OutilsStatistiques.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["mois"]) && isset($_POST["annee"])){
        $mois = $_POST["mois"];
        $annee = $_POST["annee"];

        $dateDebut = "$annee/01/$mois";
        $dateFin = "$annee/31/$mois";

        $Statistiques = getStatistiques($dateDebut, $dateFin);

    }
}
include "$racine/vue/OutilsStatistiques.php";
?>