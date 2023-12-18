<?php
include_once "bd.inc.php";

function getInterventionByDate($DateI){
    $resultat = array();
    
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE DateVisite = :DateI;");
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

function getInterventionByMatricule($MatriculeTech){
    $resultat = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE Matricule = :NumTech;");
        $req->bindValue(':NumTech', $MatriculeTech, PDO::PARAM_INT);

        $req->execute();
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    }catch(PDOException $e){
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getInterventionByDateMatricule($dateIntervention,$numeroTechnicien){
    $resultat = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE Matricule = :NumTech AND DateVisite = :DateI;");
        $req->bindValue(':NumTech', $numeroTechnicien, PDO::PARAM_INT);
        $req->bindValue(':DateI', $dateIntervention, PDO::PARAM_STR);

        $req->execute();
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    }catch(PDOException $e){
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
?>