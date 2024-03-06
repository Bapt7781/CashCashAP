<?php
// Vérifiez le rôle de l'utilisateur
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") { //Affichage ci-dessous si role = assistant
    include "$racine/vue/entete.php";

?>
<body>
    <h3>Visites Non affectées</h3>
    <h3>Visites affectées</h3>
</body>
</html>
<?php } else{
    include "$racine/controleur/connexion.php";
}
}else {
    include "$racine/controleur/connexion.php";
}

?>