<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercherInterventionAssistant.inc.php";

// Vérifie si le formulaire de recherche a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["Date_Intervention"]) && !empty($_POST["Date_Intervention"])) {
        // Récupère les données du formulaire pour la recherche par date
        $dateIntervention = $_POST["Date_Intervention"];
        $intervention = getInterventionByDate($dateIntervention);
    } elseif (isset($_POST["Numero_Technicien"]) && !empty($_POST["Numero_Technicien"])) {
        // Récupère les données du formulaire pour la recherche par technicien
        $numeroTechnicien = $_POST["Numero_Technicien"];
        $intervention = getInterventionByMatricule($numeroTechnicien);
    } elseif (isset($_POST["Date_Intervention"], $_POST["Numero_Technicien"]) && !empty($_POST["Date_Intervention"]) && !empty($_POST["Numero_Technicien"])) {
        // Récupère les données du formulaire pour la recherche par date et technicien
        $dateIntervention = $_POST["Date_Intervention"];
        $numeroTechnicien = $_POST["Numero_Technicien"];
        $intervention = getInterventionByDateMatricule($dateIntervention, $numeroTechnicien);
    }
}


// Vérifie si le formulaire de modification a été soumis
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "modifier") {
    $numero_intervention = isset($_POST['numero_intervention']) ? $_POST['numero_intervention'] : '';
    $information_intervention = getInformationIntervention($numero_intervention);
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueConsulterInterventionAssistant.php";
?>
