<?php
include_once "bd.inc.php";

VerificationConnexion();

function getRecherchefiche($numero_client) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT DISTINCT c.NumeroClient, c.RaisonSociale, c.Siren, c.CodeApe, c.Adresse, c.TelephoneClient, c.Email, c.DureeDeplacement, c.DistanceKm, c.NumeroAgence,
        cm.NumeroDeContrat, cm.DateSignature, cm.DateEcheance, cm.RefTypeContrat,
        i.NumeroIntervention, i.DateVisite, i.HeureVisite
        FROM client c
        LEFT JOIN contratdemaintenance cm ON c.NumeroClient = cm.NumeroClient
        LEFT JOIN intervention i ON c.NumeroClient = i.NumeroClient
        LEFT JOIN materiel m ON c.NumeroClient = m.NumeroClient
        WHERE c.NumeroClient = :numero_client");

        $req->bindParam(":numero_client", $numero_client, PDO::PARAM_INT);

        $req->execute();
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
function getRechercheficheInfo($numero_client) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT DISTINCT c.NumeroClient, c.RaisonSociale, c.Siren, c.CodeApe, c.Adresse, c.TelephoneClient, c.Email, c.DureeDeplacement, c.DistanceKm, c.NumeroAgence,
        cm.NumeroDeContrat, cm.DateSignature, cm.DateEcheance, cm.RefTypeContrat,
        i.NumeroIntervention, i.DateVisite, i.HeureVisite
        FROM client c
        LEFT JOIN contratdemaintenance cm ON c.NumeroClient = cm.NumeroClient
        LEFT JOIN intervention i ON c.NumeroClient = i.NumeroClient
        LEFT JOIN materiel m ON c.NumeroClient = m.NumeroClient
        WHERE c.NumeroClient = :numero_client");

        $req->bindParam(":numero_client", $numero_client, PDO::PARAM_INT);

        $req->execute();
        $resultats = $req->fetch(PDO::FETCH_ASSOC);
        return $resultats;
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
    function getRecherchemateriel($numero_client) {
        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT NumeroDeSerie, DateDeVente, DateInstallation, PrixDeVente, Emplacement, ReferenceInterne
            FROM `materiel`
            WHERE NumeroClient = :numero_client;");
    
            $req->bindParam(":numero_client", $numero_client, PDO::PARAM_INT);
    
            $req->execute();
            $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        }
        catch (Exception $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
}

?>