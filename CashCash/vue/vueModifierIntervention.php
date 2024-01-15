<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") { //Affichage ci-dessous si role = assistant
        include "$racine/vue/entete.php";
?>
<link rel="stylesheet" href="./css/ModifierInt.css">

<?php } else{
    include "$racine/controleur/connexion.php";
}
}else {
    include "$racine/controleur/connexion.php";
}

?>