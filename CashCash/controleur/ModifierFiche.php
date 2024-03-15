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
            $numero_agence = $_POST['numero_agence']; 
            $numero_contrat = $_POST['numero_contrat'];
            $date_signature = $_POST['date_signature'];
            $date_echeance = $_POST['date_echeance'];
            $ref_type_contrat = $_POST['ref_type_contrat'];
            $Numero_intervention = $_POST['numero_intervention'];
            $Date_visite = $_POST['Date_visite'];
            $Heure_visite = $_POST['Heure_visite'];

            getModifInfoClient([
                'numeroClient' => $numero_client, 
                'RaisonSociale' => $raison_sociale, 
                'Siren' => $siren,
                'CodeApe' => $code_ape,
                'Adresse' => $adresse,
                'TelephoneClient' => $telephone_client,
                'Email' => $email,
                'DureeDeplacement' => $duree_deplacement,
                'DistanceKm' => $distance_km,
                'NumeroAgence' => $numero_agence,
                'DateSignature' => $date_signature,
                'DateEcheance' => $date_echeance,
                'NumContrat' => $numero_contrat,
                'RefTypeContrat' => $ref_type_contrat,
                'DateVisite' => $Date_visite,
                'HeureVisite' => $Heure_visite,
                'NumIntervention' => $Numero_intervention
            ]);



        }elseif($action === 'modifierInfoClientMat'){
            $numero_serie = $_POST['numero_serie'];
            $numero_client = $_POST['numero_client'];
            $Date_de_vente = $_POST['Date_de_vente'];
            $Date_installation = $_POST['Date_installation'];
            $Prix_de_vente = $_POST['Prix_de_vente'];
            $Emplacement = $_POST['Emplacement'];

            getModifInfoClientMat([
                'numero_serie'=> $numero_serie,
                'Date_de_vente'=> $Date_de_vente ,
                'Date_installation'=> $Date_installation ,
                'Prix_de_vente'=> $Prix_de_vente ,
                'Emplacement'=> $Emplacement
            ]);



        }elseif ($action === 'Supp') {
            $NumSerie = $_POST['numero_serie']; // Utiliser le bon nom de champ caché
            echo $NumSerie;
            SuppressionControleIntervention([
                'NumSerie' => $NumSerie,
            ]);
        }elseif($action === 'ajouterMateriel') {

        }
    }
}

include "$racine/vue/vueModifierFiche.php";
?>
