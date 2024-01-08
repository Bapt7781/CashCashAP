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
</head>
<body>

<!-- Contenu de la page d'accueil -->




<!-- Formulaire avec un bouton de déconnexion -->
<form method="post" action="./?action=deconnexion">
    <button type="submit" class="btn btn-primary" name="logout">Déconnexion</button>
</form>

</body>
</html>
