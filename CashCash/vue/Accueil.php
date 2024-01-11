<?php
include_once "$racine/modele/authentification.inc.php";
include "$racine/vue/entete.php";
// Vérifiez le rôle de l'utilisateur
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<!-- Contenu de la page d'accueil -->

<?php 
    if ($role == "assistant") { //Affichage ci-dessous correspond aux assistants
    ?>
<div class="container mt-5">
    <div class="row mx-5">
        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Consulter les interventions</h5>
                <a href="./?action=RechercherIntervention" class="btn btn-primary">Redirection</a>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                <img src="./images/ScreenConsulterIntervention.png" class="card-img-bottom">
            </div>
        </div>


        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Outil statistique</h5>
                <a href="./?action=Statistiques" class="btn btn-primary">Redirection</a>
            </div>
        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
            <img src="./images/ScreenOutilStats.png" class="card-img-bottom" style="width: 80%; height: 95%;">
            </div>  
        </div>

        <div class="card col-md-6 mx-3 mb-3 text-center" style="width: 35rem;">
            <div class="card-body bg-light p-3">
                <h5 class="card-title">Rechercher une fiche</h5>
                <a href="./?action=RechercheFiche" class="btn btn-primary">Redirection</a>
            </div>
        <div class="d-flex align-items-center justify-content-center mb-3" style="margin-top: 3%;">
            <img src="./images/ScreenRechercheFiche.png" class="card-img-bottom" style="width: 80%; height: 95%;">
            </div>  
        </div>

        <div class="card col-6 mx-3 mb-3" style="width: 35rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php 
    if ($role == "technicien") { //Affichage ci-dessous correspond aux techniciens
    ?>


<?php } ?>


</body>
</html>
