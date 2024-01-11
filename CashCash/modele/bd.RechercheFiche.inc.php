<?php
include_once "bd.inc.php";
function getStatistiques($dateDebut, $dateFin){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("");
    
    $req->execute();
    $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
    


        return $resultats;
    }catch(Exception $e){
        print "Erreur !:" .$e->getMessage();
        die();
    }
}
?>