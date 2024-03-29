<?php
include_once "$racine/modele/authentification.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-body-tertiary container-fluid">
        <form method="post" action="./?action=deconnexion">
            <button type="submit" class="btn btn-secondary" name="logout" style="width: 120px;">Déconnexion</button>
        </form>
        <h1 class="navbar-brand text-center mx-auto">CashCash</h1>
        <form method="post" action="./?action=defaut">
            <button type="submit" class="btn btn-secondary" style="width: 120px;" >Accueil</button>
        </form>
    </nav>
</div>