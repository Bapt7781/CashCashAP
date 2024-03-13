<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

include_once "$racine/modele/bd.RechercheFiche.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idnumeroclient = $_POST["numero_client"];
    $modificationclient = getRechercheficheInfo($idnumeroclient);
    $modificationMateriel = getRecherchemateriel($idnumeroclient);
    $materiel = getMateriel();



    if(isset($_POST['action'])) {
        $action = $_POST['action'];
    
        if($action === 'modifierInfoClient') {
            $numero_client = $_POST['numero_client'];
            $raison_sociale = $_POST['raison_sociale'];
            $siren = $_POST['siren'];
            $code_ape = $_POST['code_ape'];
            $adresse = $_POST['adresse'];
            $telephone_client = $_POST['telephone_client'];
            $email = $_POST['email'];
            $duree_deplacement = $_POST['duree_deplacement'];
            $distance_km = $_POST['distance_km'];
            $numero_agence = $_POST['numero_agence']; ------
            $numero_contrat = $_POST['numero_contrat'];
            $date_signature = $_POST['date_signature'];
            $date_echeance = $_POST['date_echeance'];
            $ref_type_contrat = $_POST['ref_type_contrat'];
            $Numéro_intervention = $_POST['Numéro_intervention'];
            $Date_visite = $_POST['Date_visite'];
            $Heure_visite = $_POST['Heure_visite'];





        }elseif($action === 'modifierInfoClientMat'){

        }elseif ($action === 'Supp') {

        }elseif($action === 'ajouterMateriel') {

        }
    }
}

include "$racine/vue/vueModifierFiche.php";
?>
