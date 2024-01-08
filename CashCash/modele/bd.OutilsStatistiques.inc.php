<?php
include_once "bd.inc.php";
function getStatistiques($dateDebut, $dateFin){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT e.NomEmploye, e.PrenomEmploye, 
        COUNT(i.NumeroIntervention) AS NombreInterventions, 
        SUM(cl.DistanceKm) AS DistanceTotaleKm, 
        SUM(c.TempsPasse) AS TempsTotalPasse 
        FROM intervention i 
        JOIN technicien t ON i.Matricule = t.Matricule 
        JOIN employe e ON t.Matricule = e.Matricule 
        JOIN client cl ON i.NumeroClient = cl.NumeroClient 
        JOIN controler c ON i.NumeroIntervention = c.NumeroIntervention
        WHERE i.DateVisite BETWEEN :dateDebut AND :dateFin
        GROUP BY e.Matricule;
        ");
        $req->bindValue(":dateDebut", $dateDebut, PDO::PARAM_STR);
        $req->bindValue(":dateFin", $dateFin, PDO::PARAM_STR);
        $req->execute();
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }catch(Exception $e){
        print "Erreur !:" .$e->getMessage();
        die();
    }
}
?>
