<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.OutilsStatistiques.inc.php";
include_once "$racine/modele/authentification.inc.php";
include "$racine/vue/OutilsStatistiques.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["mois"]) && isset($_POST["annee"])){
        $mois = $_POST["mois"];
        $annee = $_POST["annee"];

        $dateDebut = "$annee/01/$mois";
        $dateFin = "$annee/31/$mois";
        $resultatHTML = "<p>Résultats pour le mois $mois de l'année $annee</p>";
        echo $resultatHTML;
    }
}
?>