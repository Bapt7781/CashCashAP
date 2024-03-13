<?php
// Vérifie si le rôle de l'utilisateur est défini
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}

// Vérifie si le rôle est défini et non vide
if (isset($role) && !empty($role)) {
    // Vérifie si le rôle est "assistant"
    if ($role == "assistant") { // Affichage ci-dessous si le rôle est assistant
        // Inclut l'en-tête de la vue
        include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher une Fiche</title>
    <!-- Inclusion de la feuille de style CSS -->
    <link rel="stylesheet" href="./css/RechercheFiche.css">
    <style>
        /* Ajoutez ici votre propre style CSS si nécessaire */
    </style>
</head>

<body>
    <div class="recherchefiche">
        <h1>Rechercher une Fiche</h1>
        <!-- Formulaire de recherche de fiche -->
        <form class="form" action="./?action=RechercheFiche" method="POST">
            <label for="numero_client">Saisir un numéro client</label>
            <!-- Champ pour saisir le numéro de client -->
            <input type="text" name="numero_client" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8" class="custom-input">
            <!-- Bouton de validation -->
            <button type="submit">Valider</button>
        </form>
    </div>

    <?php
    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["numero_client"])) {
            // Récupère le numéro de client à partir du formulaire
            $numero_client = $_POST['numero_client'];
            // Récupère les informations de la fiche client
            $Recherchefiche = getRecherchefiche($numero_client);
            // Récupère les informations sur le matériel du client
            $getRecherchemateriel = getRecherchemateriel($numero_client);

            // Vérifie s'il y a des fiches client trouvées
            if (!empty($Recherchefiche)) {
                foreach ($Recherchefiche as $uneLigne) {
                    // Affiche les informations de la fiche client
                    echo "<div class='resultat-item'>";
                    echo "<table>";
                    echo "<tr><th>Numéro client</th><th>Raison sociale</th><th>Siren</th><th>Code APE</th><th>Adresse</th><th>Téléphone client</th><th>Email</th><th>Durée de déplacement</th><th>Distance Km</th><th>Numéro agence</th><th>Numéro de contrat</th><th>Date signature</th><th>Date échéance</th><th>Ref type contrat</th><th>Numéro intervention</th><th>Date visite</th><th>Heure visite</th></tr>";
                    echo "<tr>";
                    // Affiche chaque champ de la fiche client
                    echo "<td>" . $uneLigne["NumeroClient"] . "</td>";
                    echo "<td>" . $uneLigne["RaisonSociale"] . "</td>";
                    echo "<td>" . $uneLigne["Siren"] . "</td>";
                    echo "<td>" . $uneLigne["CodeApe"] . "</td>";
                    echo "<td>" . $uneLigne["Adresse"] . "</td>";
                    echo "<td>" . $uneLigne["TelephoneClient"] . "</td>";
                    echo "<td>" . $uneLigne["Email"] . "</td>";
                    echo "<td>" . $uneLigne["DureeDeplacement"] . "</td>";
                    echo "<td>" . $uneLigne["DistanceKm"] . "</td>";
                    echo "<td>" . $uneLigne["NumeroAgence"] . "</td>";
                    echo "<td>" . $uneLigne["NumeroDeContrat"] . "</td>";
                    echo "<td>" . $uneLigne["DateSignature"] . "</td>";
                    echo "<td>" . $uneLigne["DateEcheance"] . "</td>";
                    echo "<td>" . $uneLigne["RefTypeContrat"] . "</td>";
                    echo "<td>" . $uneLigne["NumeroIntervention"] . "</td>";
                    echo "<td>" . $uneLigne["DateVisite"] . "</td>";
                    echo "<td>" . $uneLigne["HeureVisite"] . "</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
            } else {
                // Affiche un message si aucune fiche client n'est trouvée
                echo "<div class='resultat-item'><p>Aucun résultat trouvé.</p></div>";
            }

            // Vérifie s'il y a des informations sur le matériel du client
            if (!empty($getRecherchemateriel)) {
                foreach ($getRecherchemateriel as $uneLigne) {
                    // Affiche les informations sur le matériel du client
                    echo "<div class='resultat-item2'>";
                    echo "<table>";
                    echo "<tr><th>Numéro de série</th><th>Date de vente</th><th>Date installation</th><th>Prix de vente</th><th>Emplacement</th><th>Référence interne</th></tr>";
                    echo "<tr>";
                    echo "<td>" . $uneLigne["NumeroDeSerie"] . "</td>";
                    echo "<td>" . $uneLigne["DateDeVente"] . "</td>";
                    echo "<td>" . $uneLigne["DateInstallation"] . "</td>";
                    echo "<td>" . $uneLigne["PrixDeVente"] . "</td>";
                    echo "<td>" . $uneLigne["Emplacement"] . "</td>";
                    echo "<td>" . $uneLigne["ReferenceInterne"] . "</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
            }
            ?>
            <!-- Formulaire pour modifier la fiche client -->
            <form action="./?action=ModifierFiche" method="post">
                <input type="hidden" name='numero_client' value='<?php echo $numero_client?>'>
                <button type="submit" class="button">Modifier</button>
            </form>
    <?php
        }
    }
    ?>
</body>

</html>

<?php
    } else {
        // Inclut le contrôleur de connexion pour les utilisateurs avec d'autres rôles que "assistant"
        include "$racine/controleur/connexion.php";
    }
}
?>
