<?php
include_once "bd.inc.php";

VerificationConnexion();

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

function getInformationIntervention($idIntervention) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT I.NumeroIntervention, I.DateVisite, I.HeureVisite, CT.NumeroClient
                            FROM intervention I
                            JOIN client CT ON I.NumeroClient = CT.NumeroClient
                            WHERE I.NumeroIntervention = :IdInter;");
        $req->bindValue(':IdInter', $idIntervention, PDO::PARAM_INT);
        $req->execute();

        // Vérifier si des données ont été trouvées
        if ($req->rowCount() == 0) {
            return null; // Aucune intervention trouvée avec cet identifiant
        }

        $resultat = $req->fetch(PDO::FETCH_ASSOC);


        return $resultat;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getInformationInterventionMateriel($idIntervention){
    try {
        $cnx = connexionPDO();

        $reqControles = $cnx->prepare("SELECT * FROM controler WHERE NumeroIntervention = :IdInter;");
        $reqControles->bindValue(':IdInter', $idIntervention, PDO::PARAM_INT);
        $reqControles->execute();
        $resultatControle = $reqControles->fetchAll(PDO::FETCH_ASSOC);

        return $resultatControle;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}













