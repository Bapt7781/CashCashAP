<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.validationIntervention.inc.php";


include "$racine/vue/vueValidationIntervention.php";