<?php
include_once "$racine/modele/authentification.inc.php";

// Vérifiez le rôle de l'utilisateur
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];

    // Utilisez le rôle pour afficher le contenu approprié
    if ($role == "technicien") {
        echo "Bienvenue, technicien!";
    } elseif ($role == "assistant") {
        echo "Bienvenue, assistant!";
    }
}
// Traitement du formulaire si le bouton a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["logout"])) {
    logout();
    header("Location: $racine/controleur/connexion.php"); // Redirection vers la page d'authentification
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

<!-- Contenu de la page d'accueil -->




<!-- Formulaire avec un bouton de déconnexion -->
<form method="post">
    <button type="submit" class="btn btn-primary" name="logout">Déconnexion</button>
</form>

</body>
</html>
