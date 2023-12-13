<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercherInterventionAssistant.inc.php";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["Date_Intervention"]) && !empty($_POST["Date_Intervention"])) {  //Cas ou il y a que la date
        // Récupère les données du formulaire pour la recherche par date
        $dateIntervention = $_POST["Date_Intervention"];
    } elseif (isset($_POST["Numero_Technicien"]) && !empty($_POST["Numero_Technicien"])) { //Cas ou il y a que le Matricule
        // Récupère les données du formulaire pour la recherche par technicien
        $numeroTechnicien = $_POST["Numero_Technicien"];
    } elseif (isset($_POST["Date_Intervention"], $_POST["Numero_Technicien"]) && !empty($_POST["Date_Intervention"]) && !empty($_POST["Numero_Technicien"])) { // Cas ou il y a les deux 
        // Récupère les données du formulaire pour la recherche par date et technicien
        $dateIntervention = $_POST["Date_Intervention"];
        $numeroTechnicien = $_POST["Numero_Technicien"];
    }
}



// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/vueConsulterInterventionAssistant.php";
?>
