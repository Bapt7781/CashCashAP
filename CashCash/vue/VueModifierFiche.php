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
            <input type='hidden' name='action' value='modifierInfoClient'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            Raison sociale: <input type='text' name='raison_sociale' value='<?php echo $modificationclient['RaisonSociale']; ?>'> <br>
            Siren: <input type='text' name='siren' value='<?php echo $modificationclient['Siren']; ?>'> <br>
            Code APE: <input type='text' name='code_ape' value='<?php echo $modificationclient['CodeApe']; ?>'> <br>
            Adresse: <input type='text' name='adresse' value='<?php echo $modificationclient['Adresse']; ?>'> <br>
            Téléphone client: <input type='text' name='telephone_client' value='<?php echo $modificationclient['TelephoneClient']; ?>'><br>
            Email: <input type='email' name='email' value='<?php echo $modificationclient['Email']; ?>'><br>
            Durée de déplacement: <input type='text' name='duree_deplacement' value='<?php echo $modificationclient['DureeDeplacement']; ?>'><br>
            Distance Km: <input type='text' name='distance_km' value='<?php echo $modificationclient['DistanceKm']; ?>'><br>
            Numéro agence: <input type='text' name='numero_agence' value='<?php echo $modificationclient['NumeroAgence']; ?>'><br>
            Numéro de contrat: <input type='text' name='numero_contrat' value='<?php echo $modificationclient['NumeroDeContrat']; ?>'><br>
            Date signature: <input type='date' name='date_signature' value='<?php echo $modificationclient['DateSignature']; ?>'><br>
            Date échéance: <input type='date' name='date_echeance' value='<?php echo $modificationclient['DateEcheance']; ?>'><br>
            Ref type contrat: <input type='text' name='ref_type_contrat' value='<?php echo $modificationclient['RefTypeContrat']; ?>'><br>
            Numéro intervention: <input type='text' name='Numéro_intervention' value='<?php echo $modificationclient['NumeroIntervention']; ?>'><br>
            Date visite: <input type='text' name='Date_visite' value='<?php echo $modificationclient['DateVisite']; ?>'><br>
            Heure visite: <input type='text' name='Heure_visite' value='<?php echo $modificationclient['HeureVisite']; ?>'><br>
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br>

        <?php
        foreach($modificationMateriel as $unMateriel){
        ?>
        <form action='./?action=ValiderInformationFiche' method='post' >
            <input type='hidden' name='action' value='modifierInfoClientMat'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            Date de vente: <input type='text' name='Date_de_vente' value='<?php echo $unMateriel['DateDeVente']; ?>'><br>
            Date installation: <input type='text' name='Date_installation' value='<?php echo $unMateriel['DateInstallation']; ?>'><br>
            Prix de vente: <input type='text' name='Prix_de_vente' value='<?php echo $unMateriel['PrixDeVente']; ?>'><br>
            Emplacement: <input type='text' name='Emplacement' value='<?php echo $unMateriel['Emplacement']; ?>'><br>
            Reference Interne: <input type='text' name='Emplacement' value='<?php echo $unMateriel['ReferenceInterne']; ?>'><br>
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br>
        <?php } ?>

        <form action='./?action=ValiderInformation' method='post' id="page">
            <h3>Nouveau Matériel pour le client :</h3>
            <input type='hidden' name='action' value='ajouterMateriel'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            Date de vente: <input type='text' name='Date_de_vente' value='<?php echo $unMateriel['DateDeVente']; ?>'><br>
            Date installation: <input type='text' name='Date_installation' value='<?php echo $unMateriel['DateInstallation']; ?>'><br>
            Prix de vente: <input type='text' name='Prix_de_vente' value='<?php echo $unMateriel['PrixDeVente']; ?>'><br>
            Emplacement: <input type='text' name='Emplacement' value='<?php echo $unMateriel['Emplacement']; ?>'><br>
            <select name="ReferenceInterne"></select>
            <button type='submit' onclick='window.location.reload();'>Ajouter le contrôle</button>
        </form>

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
