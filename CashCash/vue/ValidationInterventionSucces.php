<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}

if (isset($role) && !empty($role)) {
    if ($role == "technicien") { // Affichage ci-dessous si le rôle est technicien
        include "$racine/vue/entete.php";
?>

<?php
    } else {
        include "$racine/controleur/connexion.php";
    }
} else {
    include "$racine/controleur/connexion.php";
}
?>