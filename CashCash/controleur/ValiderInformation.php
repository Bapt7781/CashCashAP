<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercherInterventionAssistant.inc.php";
include_once "$racine/modele/bd.ModifierIntervention.inc.php";

// Vérifier si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer toutes les données du formulaire
    $numeroIntervention = $_POST['numero_intervention'];
    $dateVisite = $_POST['date_visite'];
    $heureVisite = $_POST['heure_visite'];
    $numeroClient = $_POST['numero_client'];

    // Vous pouvez également récupérer d'autres champs du formulaire ici

    // Appeler la fonction pour valider les informations de l'intervention
    ValiderInformationIntervention([
        'numero_intervention' => $numeroIntervention,
        'date_visite' => $dateVisite,
        'heure_visite' => $heureVisite,
        'numero_client' => $numeroClient,
        // Ajoutez d'autres champs du formulaire au besoin
    ]);
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueModifierIntervention.php";
?>
