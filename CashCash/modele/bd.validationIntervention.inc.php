<?php
include_once "bd.inc.php";

VerificationConnexion();

function getInformationForTable(){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT 
        intervention.NumeroIntervention,
        client.DistanceKm,
        materiel.NumeroDeSerie
        FROM
            client
        JOIN
            intervention ON client.NumeroClient = intervention.NumeroClient
        JOIN
            materiel ON client.NumeroClient = materiel.NumeroClient
        JOIN 
            typemateriel ON materiel.ReferenceInterne = typemateriel.ReferenceInterne
        WHERE
            intervention.Matricule IS NOT NULL
        ORDER BY 1 ASC;
        ");
        $req->execute();
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getInformationForModal($numeroIntervention){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT 
        materiel.NumeroDeSerie, 
        typemateriel.LibelleTypeMateriel
        FROM materiel
        JOIN typemateriel ON materiel.ReferenceInterne = typemateriel.ReferenceInterne
        JOIN client ON materiel.NumeroClient = client.NumeroClient
        JOIN intervention ON intervention.NumeroClient = client.NumeroClient
        WHERE intervention.NumeroIntervention = :NumeroIntervention");
        $req->bindValue(":NumeroIntervention", $numeroIntervention, PDO::PARAM_INT);
        $req->execute();
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    }catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}