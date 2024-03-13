<?php 
// Inclut le fichier "getRacine.php" pour obtenir la racine du projet
include "getRacine.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <!-- Inclut le fichier CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Inclut le fichier JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Inclut le fichier CSS personnalisé pour l'authentification -->
    <link rel="stylesheet" href="./css/Authentification.css">
</head>
<body>
    <!-- Formulaire d'authentification -->
    <form action="./?action=authentification" method="POST">
        <div class="mb-3 col">
          <label for="exampleFormControlInput1" class="form-label">Matricule</label>
          <!-- Champ pour entrer le matricule de l'utilisateur -->
          <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Ex : 5" name="matriculeU">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
          <!-- Champ pour entrer le mot de passe de l'utilisateur -->
          <input type="password" class="form-control" id="exampleInputPassword1" name="mdpU">
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="col-auto text-center">
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</body>
</html>
