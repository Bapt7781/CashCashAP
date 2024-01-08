<?php
include_once "$racine/modele/authentification.inc.php";

// Vérifiez le rôle de l'utilisateur
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
// Traitement du formulaire si le bouton a été soumis
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout"])) {
    
//     try {
//         logout();
    
//         header("Cache-Control: no-cache, must-revalidate");
//         header("Location: $racine/index.php"); // Redirection vers la page d'authentification
//         exit();
//     } catch (Exception $e) {
//         echo 'Erreur : ',  $e->getMessage(), "\n";
//     }
    
// }
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
    if ($role == "assistant") { //Affichage ci-dessous correspond aux techniciens
    ?>
    <div class="container mt-5">
        <div class="titre text-center mb-5"><h1>CashCash</h1></div>
        <div class="row justify-content-center ">
            <div class="card mx-3" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Consulter les interventions</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card mx-3" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card mx-3" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card mx-3" style="width: 18rem;">
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
    if ($role == "technicien") { //Affichage ci-dessous correspond aux assistants
    ?>


<?php } ?>
<!-- Formulaire avec un bouton de déconnexion -->
<div class="position-absolute top-0 start-0 mt-3 ms-3">
    <form method="post" action="./?action=deconnexion">
        <button type="submit" class="btn btn-secondary" name="logout">Déconnexion</button>
    </form>
</div>

</body>
</html>
