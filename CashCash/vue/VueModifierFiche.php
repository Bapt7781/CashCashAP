<?php
// Vérifie si la session contient le rôle de l'utilisateur
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
// Vérifie si le rôle est défini et non vide
if (isset($role) && !empty($role)) {
    // Vérifie si le rôle est assistant
    if ($role == "assistant") {
        // Inclut l'entête de la vue
        include "$racine/vue/entete.php";
?>
        <!-- Titre de la page -->
        <title>Modification des informations de la fiche</title>
        <!-- Lien vers la feuille de style CSS -->
        <link rel="stylesheet" href="./css/ModifierFiche.css">
        <br><br><br>
        
        <!-- Formulaire pour modifier les informations de la fiche -->
        <form action='./?action=ValiderInformationFiche' method='post' id="page">
            <h3>Modifier les informations de la fiche :</h3>
            <!-- Champs cachés pour les informations -->
            <input type='hidden' name='action' value='modifierInfoClient'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            <!-- Champs de saisie pour les informations de la fiche -->
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
            <!-- Boutons pour valider ou annuler les modifications -->
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br>

        <!-- Boucle pour afficher les informations de chaque matériel -->
        <?php
        foreach($modificationMateriel as $unMateriel){
        ?>
        <!-- Formulaire pour modifier les informations du matériel -->
        <form action='./?action=ValiderInformationFiche' method='post' >
            <input type='hidden' name='action' value='modifierInfoClientMat'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            <!-- Champs de saisie pour les informations du matériel -->
            Date de vente: <input type='text' name='Date_de_vente' value='<?php echo $unMateriel['DateDeVente']; ?>'><br>
            Date installation: <input type='text' name='Date_installation' value='<?php echo $unMateriel['DateInstallation']; ?>'><br>
            Prix de vente: <input type='text' name='Prix_de_vente' value='<?php echo $unMateriel['PrixDeVente']; ?>'><br>
            Emplacement: <input type='text' name='Emplacement' value='<?php echo $unMateriel['Emplacement']; ?>'><br>
            Reference Interne: <input type='text' name='Emplacement' value='<?php echo $unMateriel['ReferenceInterne']; ?>'><br>
            <!-- Boutons pour valider ou annuler les modifications -->
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br>
        <?php } ?>

        <!-- Formulaire pour ajouter un nouveau matériel pour le client -->
        <form action='./?action=ValiderInformation' method='post' id="page">
            <h3>Nouveau Matériel pour le client :</h3>
            <input type='hidden' name='action' value='ajouterMateriel'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            <!-- Champs de saisie pour les informations du nouveau matériel -->
            Date de vente: <input type='text' name='Date_de_vente' value='<?php echo $unMateriel['DateDeVente']; ?>'><br>
            Date installation: <input type='text' name='Date_installation' value='<?php echo $unMateriel['DateInstallation']; ?>'><br>
            Prix de vente: <input type='text' name='Prix_de_vente' value='<?php echo $unMateriel['PrixDeVente']; ?>'><br>
            Emplacement: <input type='text' name='Emplacement' value='<?php echo $unMateriel['Emplacement']; ?>'><br>
            <select name="ReferenceInterne"></select>
            <!-- Bouton pour ajouter le nouveau matériel -->
            <button type='submit' onclick='window.location.reload();'>Ajouter le matériel</button>
        </form>

<?php
    } else {
        // Inclut le contrôleur de connexion pour les autres rôles
        include "$racine/controleur/connexion.php";
    }
} else {
    // Inclut le contrôleur de connexion si le rôle n'est pas défini
    include "$racine/controleur/connexion.php";
}
?>
