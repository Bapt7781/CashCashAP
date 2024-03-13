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
        <link rel="stylesheet" href="./css/ModifFiche.css">
        <br><br><br>
        
        <form action='./?action=ModifierFiche' method='post' id="page">
            <h3>Modifier les informations de la fiche :</h3>
            <!-- Champs cachés pour les informations -->
            <input type='hidden' name='action' value='modifierInfoClient'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            <!-- Champs de saisie pour les informations de la fiche -->
            Raison sociale: <input type='text' name='raison_sociale' value='<?php echo $modificationclient['RaisonSociale']; ?>'> <br>
            Siren: <input type='number' name='siren' value='<?php echo $modificationclient['Siren']; ?>'> <br>
            Code APE: <input type='number' name='code_ape' value='<?php echo $modificationclient['CodeApe']; ?>'> <br>
            Adresse: <input type='text' name='adresse' value='<?php echo $modificationclient['Adresse']; ?>'> <br>
            Téléphone client: <input type='text' name='telephone_client' value='<?php echo $modificationclient['TelephoneClient']; ?>'><br>
            Email: <input type='email' name='email' value='<?php echo $modificationclient['Email']; ?>'><br>
            Durée de déplacement: <input type='number' step="0.01" name='duree_deplacement' value='<?php echo $modificationclient['DureeDeplacement']; ?>'><br>
            Distance Km: <input type='number' step="0.01" name='distance_km' value='<?php echo $modificationclient['DistanceKm']; ?>'><br>
            Numéro agence: <input type='number' name='numero_agence' value='<?php echo $modificationclient['NumeroAgence']; ?>'><br>
            Numéro de contrat: <input type='number' name='numero_contrat' value='<?php echo $modificationclient['NumeroDeContrat']; ?>'><br>
            Date signature: <input type='date' name='date_signature' value='<?php echo $modificationclient['DateSignature']; ?>'><br>
            Date échéance: <input type='date' name='date_echeance' value='<?php echo $modificationclient['DateEcheance']; ?>'><br>
            Ref type contrat: <input type='number' name='ref_type_contrat' value='<?php echo $modificationclient['RefTypeContrat']; ?>'><br>
            Numéro intervention: <input type='number' name='Numéro_intervention' value='<?php echo $modificationclient['NumeroIntervention']; ?>'><br>
            Date visite: <input type='date' name='Date_visite' value='<?php echo $modificationclient['DateVisite']; ?>'><br>
            Heure visite: <input type='time' step='1' name='Heure_visite' value='<?php echo $modificationclient['HeureVisite']; ?>'><br>
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br>

        <!-- Boucle pour afficher les informations de chaque matériel -->
        <?php
        foreach($modificationMateriel as $unMateriel){
        ?>
        <form action='./?action=ModifierFiche' method='post' id="page2">
            <h3>Modifier les matériaux du client :</h3>
            <input type='hidden' name='action' value='modifierInfoClientMat'>
            <input type='hidden' name='numero_client' value='<?php echo $modificationclient['NumeroClient']; ?>'>
            Date de vente: <input type='date' name='Date_de_vente' value='<?php echo $unMateriel['DateDeVente']; ?>'><br>
            Date installation: <input type='date' name='Date_installation' value='<?php echo $unMateriel['DateInstallation']; ?>'><br>
            Prix de vente: <input type='number' step="0.01" name='Prix_de_vente' value='<?php echo $unMateriel['PrixDeVente']; ?>'><br>
            Emplacement: <input type='text' name='Emplacement' value='<?php echo $unMateriel['Emplacement']; ?>'><br>
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='supp-button' onclick="deleteControle()">Supprimer</button>
            <input type='hidden' name='supprimer' value='true'>
        </form><br><br>
            <script>
                function deleteControle() {
                    if (confirm("Voulez-vous vraiment supprimer ce matériel ?")) {
                        // Ajouter un input supplémentaire pour indiquer la suppression
                        var form = document.getElementById('page2');
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'action';
                        input.value = 'Supp';
                        form.appendChild(input);

                        // Soumettre le formulaire
                        form.submit();
                    }
                }
            </script>
        <?php } ?>

        <form action='./?action=ModifierFiche' method='post' id="page">
            <h3>Nouveau Matériel pour le client :</h3>
            <input type='hidden' name='action' value='ajouterMateriel'>
            <input type='hidden' name='numero_client' value='<?php $modificationclient['NumeroClient']; ?>'>
            Date de vente: <input type='date' name='Date_de_vente' value=''><br>
            Date installation: <input type='date' name='Date_installation' value=''><br>
            Prix de vente: <input type='number' step="0.01" name='Prix_de_vente' value=''><br>
            Emplacement: <input type='text' name='Emplacement' value=''><br>
            <select name="ReferenceInterne">
            <?php
                foreach ($materiel as $unMateriel) {
                    echo "<option value='{$unMateriel['ReferenceInterne']}'>{$unMateriel['LibelleTypeMateriel']}</option>";
                }
            ?>
            </select>
            <button type='submit' onclick='window.location.reload();'>Ajouter le contrôle</button>
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
