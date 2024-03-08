<?php
include_once "bd.inc.php";

VerificationConnexion();

function getInformationForTable($matricule){
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
            intervention.Matricule = :matricule
        ORDER BY 2 ASC;
        ");
        $req->bindValue(":matricule", $matricule, PDO::PARAM_INT);
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
        FROM 
            materiel
        JOIN 
            typemateriel ON materiel.ReferenceInterne = typemateriel.ReferenceInterne
        JOIN 
            client ON materiel.NumeroClient = client.NumeroClient
        JOIN 
            intervention ON intervention.NumeroClient = client.NumeroClient
        WHERE 
            intervention.NumeroIntervention = :NumeroIntervention
            AND NOT EXISTS (
                SELECT 1
                FROM controler
                WHERE controler.NumeroDeSerie = materiel.NumeroDeSerie
                AND controler.NumeroIntervention = intervention.NumeroIntervention
            );
        ");
        $req->bindValue(":NumeroIntervention", $numeroIntervention, PDO::PARAM_INT);
        $req->execute();
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        return $resultats;
    }catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function addInformationToBdd($numeroIntervention, $NumeroDeSerie, $tempsPasse, $commentaire){
    try {
        $cnx = connexionPDO();

        // Remplacez les noms de colonnes et de table selon votre structure de base de données
        $req = $cnx->prepare("INSERT INTO controler (NumeroDeSerie, NumeroIntervention, TempsPasse, Commentaire) 
                                VALUES (:numeroDeSerie, :numeroIntervention, :tempsPasse, :commentaire)");

        // Liaison des paramètres avec les valeurs
        $req->bindParam(':numeroIntervention', $numeroIntervention, PDO::PARAM_INT);
        $req->bindParam(':numeroDeSerie', $NumeroDeSerie, PDO::PARAM_INT);
        $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindParam(':tempsPasse', $tempsPasse, PDO::PARAM_STR);

        $result = $req->execute();

        echo '<script>';
        if ($result) {
            echo 'alert("ajout réussie !");';
            echo 'window.location.href="?action=ValiderInterventionSuccess";';
        } else {
            echo `alert("Échec de l'ajout.");`;
            echo 'window.location.href="?action=ValiderInterventionSuccess";';
        }
        echo '</script>';

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
    