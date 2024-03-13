<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") { //Affichage ci-dessous si role = assistant
        include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="./css/RechercheFiche.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher une Fiche</title>
    <style>

    </style>
</head>
<body>
<div class="recherchefiche">
    <h1>Rechercher une Fiche</h1>
    <form class="form" action="./?action=RechercheFiche" method="POST">
        <label for="numero_client">Saisir un numéro client</label>
        <input type="text" name="numero_client" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8" class="custom-input">
        <button type="submit">Valider</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["numero_client"])) {
        $numero_client = $_POST['numero_client'];
        $Recherchefiche = getRecherchefiche($numero_client);
        $getRecherchemateriel = getRecherchemateriel($numero_client);

        if (!empty($Recherchefiche)) {
            foreach ($Recherchefiche as $uneLigne) {
                echo "<div class='resultat-item'>";
                echo "<table>";
                echo "<tr><th>Numéro client</th><th>Raison sociale</th><th>Siren</th><th>Code APE</th><th>Adresse</th><th>Téléphone client</th><th>Email</th><th>Durée de déplacement</th><th>Distance Km</th><th>Numéro agence</th><th>Numéro de contrat</th><th>Date signature</th><th>Date échéance</th><th>Ref type contrat</th><th>Numéro intervention</th><th>Date visite</th><th>Heure visite</th></tr>";
                echo "<tr>";
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
            echo "<div class='resultat-item'><p>Aucun résultat trouvé.</p></div>";
        }
        if (!empty($getRecherchemateriel)) {
            foreach ($getRecherchemateriel as $uneLigne) {
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
        include "$racine/controleur/connexion.php";
    }
}
?>
