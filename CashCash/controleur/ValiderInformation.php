<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercherInterventionAssistant.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Récupérer les données du formulaire
$idIntervention = $_POST['numero_intervention'];
$dateVisite = $_POST['date_visite'];
$heureVisite = $_POST['heure_visite'];
$numerosSerie = $_POST['numeros_serie']; // Ceci sera un tableau, car c'est un champ caché contenant les numéros de série
$tempsPasse = $_POST['temps_passe'];
$commentaires = $_POST['commentaire'];
$numeroClient = $_POST['numero_client']; // Récupérer le numéro du client (peut être un tableau s'il y en a plusieurs)

// Appeler la fonction pour mettre à jour les données dans la base de données
updateInformationIntervention($idIntervention, $dateVisite, $heureVisite, $numerosSerie, $tempsPasse, $commentaires, $numeroClient);
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueModifierIntervention.php";
?>
