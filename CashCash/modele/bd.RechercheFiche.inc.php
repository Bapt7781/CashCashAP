<?php
include_once "bd.inc.php";

function getRecherchefiche($numero_client) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT 
            client.*,
            materiel.*,
            contratdemaintenance.*,
            typecontrat.*
        FROM
            client
        JOIN
            materiel ON client.NumeroClient = materiel.NumeroClient
        LEFT JOIN
            contratdemaintenance ON client.NumeroClient = contratdemaintenance.NumeroClient
        LEFT JOIN
            typecontrat ON contratdemaintenance.RefTypeContrat = typecontrat.RefTypeContrat
        WHERE
            client.NumeroClient = :numero_client
        ");
        $req->bindValue(":numero_client", $numero_client, PDO::PARAM_STR);
        $req->execute();
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
?>
