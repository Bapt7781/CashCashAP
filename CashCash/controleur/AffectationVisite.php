<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.AffectationVisite.inc.php";
$visitesNonAffec = getVisitesNonAffec();
$visitesAffec = getVisitesAffec();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['action'])) {
        $action = $_POST['action'];

        if($action === 'affecter') {
            $NumTech = $_POST['technicien'];
            $NumInter = $_POST['numeroIntervention'];

            AffecterVisite([
            'NumTech' => $NumTech,
            'NumIntervention' => $NumInter,]);
        }
    }
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/vueAffectationVisite.php";
?>
