<?php

if (isset($role) && !empty($role)) {
    if ($role == "assistant") { //Affichage ci-dessous si role = assistant
        include "$racine/vue/entete.php";
        
?>
<p>t</p>
<?php } else{
    echo 'p'
    include "$racine/controleur/connexion.php";
}
}else {
    include "$racine/controleur/connexion.php";
}
?>