<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}

if (isset($role) && !empty($role)) {
    if ($role == "technicien") { // Affichage ci-dessous si le rôle est technicien
        include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des interventions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<table class="table m-5 mx-auto text-center" style="width: 80%">
    <thead>
        <tr>
            <th>Numéro d'intervention</th>
            <th>Distance de l'agence</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
$information = getInformationForTable();
$interventionsDejaAffichees = array(); // Tableau pour stocker les numéros d'intervention déjà affichés

foreach ($information as $uneLigne) {
    $numeroIntervention = $uneLigne["NumeroIntervention"];

    // Vérifier si l'intervention a déjà été affichée
    if (!in_array($numeroIntervention, $interventionsDejaAffichees)) {
?>
        <tr>
            <td><?php echo $numeroIntervention; ?></td>
            <td><?php echo $uneLigne["DistanceKm"]; ?></td>
            <td>
            <button type="button" class="btn btn-primary" 
                data-bs-toggle="modal" data-bs-target="#ValidationModal"
                data-numero-intervention="<?php echo $numeroIntervention; ?>">Valider</button>
            </td>        
        </tr>
<?php
        // Ajouter le numéro d'intervention au tableau des interventions déjà affichées
        $interventionsDejaAffichees[] = $numeroIntervention;
    }
}
?>

    </tbody>
</table>
<!-- Boîte de dialogue modale -->
<div class="modal" tabindex="-1" id="ValidationModal">
    <?php include "$racine/vue/vueModalValidation.php";; ?>
</div>
</body>
</html>
<?php
    } else {
        include "$racine/controleur/connexion.php";
    }
} else {
    include "$racine/controleur/connexion.php";
}
?>
