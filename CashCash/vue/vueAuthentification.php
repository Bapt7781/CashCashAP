<?php 
include "getRacine.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f8f9fa;
    }

    form {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff; 
        border-color: #007bff; 
        color: #ffffff; 
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    </style>
</head>
<body>
    <form action="./?action=authentification" method="POST">
        <div class="mb-3 col">
          <label for="exampleFormControlInput1" class="form-label">Matricule</label>
          <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Ex : 5" name="matriculeU">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="mdpU">
        </div>

        <div class="col-auto text-center">
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</body>
</html>