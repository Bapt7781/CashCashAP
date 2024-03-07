<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.validationIntervention.inc.php";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $commentaire = $_POST["commentaire"];
        $tempsPasse = $_POST["tempsPasse"];
        $numeroIntervention = $_POST["numeroIntervention"];
        $numeroDeSerie = $_POST["numeroDeSerie"];
    
        addInformationToBdd($numeroIntervention, $numeroDeSerie, $tempsPasse, $commentaire);
        
    }
}catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

include "$racine/vue/vueValidationIntervention.php";