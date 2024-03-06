<?php
// getInformationForModal.php
include_once "bd.inc.php";

$numeroIntervention = $_GET['numeroIntervention'];

try {
    $informationModal = getInformationForModal($numeroIntervention);
    // Faites quelque chose avec $informationModal (par exemple, construire le HTML à afficher dans la modal)
    echo $informationModal;
} catch (Exception $e) {
    echo "Erreur !: " . $e->getMessage();
}