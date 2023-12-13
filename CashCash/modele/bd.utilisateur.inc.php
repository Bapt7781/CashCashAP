<?php

include_once "bd.inc.php";

function getUtilisateurs() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from employe");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRole($matriculeU){
    try {
        $cnx = connexionPDO();

        $reqEmpl = $cnx->prepare("select Matricule from employe");
        $reqEmpl->execute();
        $matriculesEmpl = $reqEmpl->fetchAll(PDO::FETCH_COLUMN);

        $reqTech = $cnx->prepare("SELECT Matricule FROM technicien WHERE Matricule = :matricule");
        $reqTech->execute();
        $reqTech->bindParam(':matricule', $matriculeU);
        $estTechnicien = ($reqTech->rowCount() > 0);

        $reqAssist = $cnx->prepare("SELECT Matricule FROM assistant_téléphonique WHERE Matricule = :matricule");
        $reqAssist->bindParam(':matricule', $matriculeU);   
        $reqAssist->execute();
        $estAssistant = ($reqAssist->rowCount() > 0);

        if ($estTechnicien) {
            return 'technicien';
        } elseif ($estAssistant) {
            return 'assistant';
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

}

function getUtilisateurByMatriculeU($matriculeU) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from employe where matricule=:matriculeU");
        $req->bindValue(':matriculeU', $matriculeUU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}