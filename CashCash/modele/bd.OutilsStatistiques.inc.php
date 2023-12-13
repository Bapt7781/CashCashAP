<?php
include_once "bd.inc.php";

function getStatistiques(){
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT e.NomEmploye, e.PrenomEmploye, 
                                COUNT(i.NuméroIntervention) AS NombreInterventions, 
                                SUM(cl.DistanceKm) AS DistanceTotaleKm, 
                                SUM(c.TempsPasse) AS TempsTotalPasse 
                                FROM intervention i 
                                JOIN technicien t ON i.Matricule = t.Matricule 
                                JOIN employe e ON t.Matricule = e.Matricule 
                                JOIN client cl ON i.NumeroClient = cl.NumeroClient 
                                JOIN controler c ON i.NuméroIntervention = c.NuméroIntervention 
                                GROUP BY e.Matricule;");

        $req->execute();
    }
}
?>