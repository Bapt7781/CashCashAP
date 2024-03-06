<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercherInterventionAssistant.inc.php";
include_once "$racine/modele/bd.ModifierIntervention.inc.php";

// Vérifier si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
    
        if($action === 'modifier') {
            // Logique pour la modification de l'intervention
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
                'numero_client' => $numeroClient,]);
        }elseif($action === 'MaterielModif'){
            $NumeroIntervention = $_POST['numero_intervention']; 
            $AncienNumSerie = $_POST['controle_numero_serieAc'];
            $NouveauNumSerie = $_POST['controle_numero_serieNv'];
            $TempsPasse = $_POST['controle_temps_passe'];
            $Commentaire = $_POST['controle_commentaire'];

            ModificationControleIntervention([
                'NumeroIntervention' => $NumeroIntervention,
                'AncienNumSerie' => $AncienNumSerie,
                'NouveauNumSerie' => $NouveauNumSerie,
                'TempsPasse' => $TempsPasse,
                'Commentaire' => $Commentaire,]);
        }elseif ($action === 'Supp') {
            
            $NumeroIntervention = $_POST['numero_intervention'];
            $NumSerie = $_POST['controle_numero_serieAc']; // Utiliser le bon nom de champ caché
            
        
            SuppressionControleIntervention([
                'NumeroIntervention' => $NumeroIntervention,
                'NumSerie' => $NumSerie,
            ]);
        }elseif($action === 'ajouter') {
            // Logique pour l'ajout d'un nouveau contrôle de matériel
            $NumeroIntervention = $_POST['numero_intervention'];           
            $NumeroDeSerie = $_POST['nouveau_numero_serie'];
            $TempsPasse = $_POST['nouveau_temps_passe'];
            $Commentaire = $_POST['nouveau_commentaire'];

            ajouteControleIntervention([
                'NumeroIntervention' => $NumeroIntervention,
                'NumeroDeSerie' => $NumeroDeSerie,
                'TempsPasse' => $TempsPasse,
                'Commentaire' => $Commentaire]);

        }
    }
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueModifierIntervention.php";
?>
