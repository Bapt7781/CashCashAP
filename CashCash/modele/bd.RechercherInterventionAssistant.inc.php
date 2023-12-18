<?php
include_once "bd.inc.php";

function getInterventionByDate($DateI){
    $resultat = array();
    
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NuméroIntervention FROM intervention WHERE DateVisite = :DateI;");
        $req->bindValue(':DateI', $DateI, PDO::PARAM_STR);

        $req->execute();
        
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    } catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat;
}

function getInterventionByMatricule(){
    $resultat = array();
}

function getInterventionByDateMatricule(){
    $resultat = array();
}
?>