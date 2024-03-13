<?php
// Inclut le fichier de connexion à la base de données
include_once "bd.inc.php";

// Vérifie la connexion à la base de données
VerificationConnexion();

// Fonction pour obtenir les informations à afficher dans la table des interventions pour un matricule donné
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
        // En cas d'erreur, affiche l'erreur et arrête le script
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour obtenir les informations à afficher dans le modal de validation pour un numéro d'intervention donné
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
        // En cas d'erreur, affiche l'erreur et arrête le script
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour ajouter des informations à la base de données pour une intervention validée
function addInformationToBdd($numeroIntervention, $NumeroDeSerie, $tempsPasse, $commentaire){
    try {
        $cnx = connexionPDO();

        // Prépare la requête d'insertion dans la table controler
        $req = $cnx->prepare("INSERT INTO controler (NumeroDeSerie, NumeroIntervention, TempsPasse, Commentaire) 
                                VALUES (:numeroDeSerie, :numeroIntervention, :tempsPasse, :commentaire)");

        // Lie les paramètres aux valeurs
        $req->bindParam(':numeroIntervention', $numeroIntervention, PDO::PARAM_INT);
        $req->bindParam(':numeroDeSerie', $NumeroDeSerie, PDO::PARAM_INT);
        $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindParam(':tempsPasse', $tempsPasse, PDO::PARAM_STR);

        // Exécute la requête
        $result = $req->execute();

        // Affiche un message d'alerte selon le résultat de l'ajout
        echo '<script>';
        if ($result) {
            echo 'alert("Ajout réussi !");';
            echo 'window.location.href="?action=ValiderInterventionSuccess";';
        } else {
            echo `alert("Échec de l'ajout.");`;
            echo 'window.location.href="?action=ValiderInterventionSuccess";';
        }
        echo '</script>';

    } catch (PDOException $e) {
        // En cas d'erreur PDO, affiche l'erreur
        echo "Erreur : " . $e->getMessage();
    }
}
