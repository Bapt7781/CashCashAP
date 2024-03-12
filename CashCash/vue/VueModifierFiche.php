<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") {
        include "$racine/vue/entete.php";
?>
        <title>Modification des informations de la fiche</title>
        <link rel="stylesheet" href="./css/ModifierFiche.css">
        <br><br><br>
        
        <form action='./?action=ValiderInformationFiche' method='post' id="page">
            <h3>Modifier les informations de la fiche :</h3>
            <input type='hidden' name='action' value='modifier'>
            <input type='hidden' name='numero_client' value='<?php echo $modification['NumeroClient']; ?>'>
            Raison sociale: <input type='text' name='raison_sociale' value='<?php echo $modification['RaisonSociale']; ?>'> <br>
            Siren: <input type='text' name='siren' value='<?php echo $modification['Siren']; ?>'> <br>
            Code APE: <input type='text' name='code_ape' value='<?php echo $modification['CodeApe']; ?>'> <br>
            Adresse: <input type='text' name='adresse' value='<?php echo $modification['Adresse']; ?>'> <br>
            Téléphone client: <input type='text' name='telephone_client' value='<?php echo $modification['TelephoneClient']; ?>'><br>
            Email: <input type='email' name='email' value='<?php echo $modification['Email']; ?>'><br>
            Durée de déplacement: <input type='text' name='duree_deplacement' value='<?php echo $modification['DureeDeplacement']; ?>'><br>
            Distance Km: <input type='text' name='distance_km' value='<?php echo $modification['DistanceKm']; ?>'><br>
            Numéro agence: <input type='text' name='numero_agence' value='<?php echo $modification['NumeroAgence']; ?>'><br>
            Numéro de contrat: <input type='text' name='numero_contrat' value='<?php echo $modification['NumeroDeContrat']; ?>'><br>
            Date signature: <input type='date' name='date_signature' value='<?php echo $modification['DateSignature']; ?>'><br>
            Date échéance: <input type='date' name='date_echeance' value='<?php echo $modification['DateEcheance']; ?>'><br>
            Ref type contrat: <input type='text' name='ref_type_contrat' value='<?php echo $modification['RefTypeContrat']; ?>'><br>
            Numéro intervention: <input type='text' name='Numéro_intervention' value='<?php echo $modification['NumeroIntervention']; ?>'><br>
            Date visite: <input type='text' name='Date_visite' value='<?php echo $modification['DateVisite']; ?>'><br>
            Heure visite: <input type='text' name='Heure_visite' value='<?php echo $modification['HeureVisite']; ?>'><br>
            Numéro de série: <input type='text' name='Numéro_de_série' value='<?php echo $modification['NumeroDeSérie']; ?>'><br>
            Date de vente: <input type='text' name='Date_de_vente' value='<?php echo $modification['DateDeVente']; ?>'><br>
            Date installation: <input type='text' name='Date_installation' value='<?php echo $modification['DateInstallation']; ?>'><br>
            Prix de vente: <input type='text' name='Prix_de_vente' value='<?php echo $modification['PrixDevente']; ?>'><br>
            Emplacement: <input type='text' name='Emplacement' value='<?php echo $modification['Emplacement']; ?>'><br>
            Référence interne: <input type='text' name='Reference_interne' value='<?php echo $modification['ReferenceInterne']; ?>'><br>
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br><br><br>

        <style>
           .cancel-button {
                background-color: #dc3545;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .cancel-button:hover {
                background-color: #b02a37;
            }

            .supp-button {
                background-color: #dc3545;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .supp-button:hover {
                background-color: #b02a37;
            }
        </style>

<?php
    } else {
        include "$racine/controleur/connexion.php";
    }
} else {
    include "$racine/controleur/connexion.php";
}
?>
