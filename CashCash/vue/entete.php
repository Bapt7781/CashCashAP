<?php
include_once "$racine/modele/authentification.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <div class="position-absolute top-0 start-0 mt-3 ms-3">
    <form method="post" action="./?action=deconnexion">
        <button type="submit" class="btn btn-secondary" name="logout">Déconnexion</button>
    </form>

    <h1>CashCash</h1>

    </div>
  </div>
</nav> -->
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