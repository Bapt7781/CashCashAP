<?php
// Inclut le fichier d'en-tête de la page
include "$racine/vue/entete.php";
// Vérifie le rôle de l'utilisateur
if (isset($_SESSION["role"])) {
    // Récupère le rôle depuis la session
    $role = $_SESSION["role"];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <!-- Inclut le fichier CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Inclut le fichier JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<!-- Contenu de la page d'accueil -->

<?php 
// Si le rôle de l'utilisateur est "assistant", affiche les éléments correspondants
if ($role == "assistant") { 
?>
<div class="container mt-5">
    <div class="row mx-5">
        <!-- Carte pour consulter les interventions -->
        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Consulter les interventions</h5>
                <a href="./?action=RechercherIntervention" class="btn btn-primary">Redirection</a>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                <img src="./images/ScreenConsulterIntervention.png" class="card-img-bottom">
            </div>
        </div>

        <!-- Carte pour l'outil statistiques -->
        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Outil statistiques</h5>
                <a href="./?action=Statistiques" class="btn btn-primary">Redirection</a>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                <img src="./images/ScreenOutilStats.png" class="card-img-bottom" style="width: 80%; height: 95%;">
            </div>
        </div>

        <!-- Carte pour rechercher une fiche -->
        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Rechercher une fiche</h5>
                <a href="./?action=RechercheFiche" class="btn btn-primary">Redirection</a>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-3" style="margin-top: 3%;">
                <img src="./images/ScreenRechercheFiche.png" class="card-img-bottom" style="width: 80%; height: 95%;">
            </div>
        </div>

        <!-- Carte pour affecter une visite -->
        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Affecter une Visite</h5>
                <a href="./?action=AffectationVisite" class="btn btn-primary">Redirection</a>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-3" style="margin-top: 3%;">
                <img src="./images/ScreenAffectationVisites.png" class="card-img-bottom" style="width: 80%; height: 95%;">
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php 
// Si le rôle de l'utilisateur est "technicien", affiche les éléments correspondants
if ($role == "technicien") { 
?>
<div class="container mt-5">
    <div class="row mx-5">
        <!-- Carte pour consulter les interventions -->
        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Consulter les interventions</h5>
                <a href="./?action=ValiderIntervention" class="btn btn-primary">Redirection</a>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                <img src="./images/ScreenValidationIntervention.png" class="card-img-bottom">
            </div>
        </div>
    </div>
</div>
<?php } ?>

</body>
</html>
