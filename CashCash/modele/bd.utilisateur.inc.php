<?php

include_once "bd.inc.php";

function VerificationConnexion(){
    // recuperation des donnees GET, POST, et SESSION
    if (isset($_POST["matriculeU"]) && isset($_POST["mdpU"])){
        $matriculeU=$_POST["matriculeU"];
        $mdpU=$_POST["mdpU"];
    }
    else
    {
        $matriculeU="";
        $mdpU="";
    }
    login($matriculeU,$mdpU);
}

function getEmploye() {

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

        $reqEmpl = $cnx->prepare("SELECT Matricule FROM employe");
        $reqEmpl->execute();
        $matriculesEmpl = $reqEmpl->fetchAll(PDO::FETCH_COLUMN);
        
        $reqTech = $cnx->prepare("SELECT Matricule FROM technicien WHERE Matricule = :matricule");
        $reqTech->bindParam(':matricule', $matriculeU, PDO::PARAM_INT);
        $reqTech->execute();
        $estTechnicien = ($reqTech->rowCount() > 0);
        
        $reqAssist = $cnx->prepare("SELECT Matricule FROM assistant_telephonique WHERE Matricule = :matricule");
        $reqAssist->bindParam(':matricule', $matriculeU, PDO::PARAM_INT); 
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
        $req->bindValue(':matriculeU', $matriculeU, PDO::PARAM_INT);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}