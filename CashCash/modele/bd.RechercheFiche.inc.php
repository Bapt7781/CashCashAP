<?php
// Inclusion du fichier de connexion à la base de données
include_once "bd.inc.php";

// Vérification de la connexion à la base de données
VerificationConnexion();

// Fonction pour récupérer les informations de la fiche client
function getRecherchefiche($numero_client) {
    try {
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête SQL pour sélectionner les informations de la fiche client
        $req = $cnx->prepare("SELECT DISTINCT c.NumeroClient, c.RaisonSociale, c.Siren, c.CodeApe, c.Adresse, c.TelephoneClient, c.Email, c.DureeDeplacement, c.DistanceKm, c.NumeroAgence,
        cm.NumeroDeContrat, cm.DateSignature, cm.DateEcheance, cm.RefTypeContrat,
        i.NumeroIntervention, i.DateVisite, i.HeureVisite
        FROM client c
        LEFT JOIN contratdemaintenance cm ON c.NumeroClient = cm.NumeroClient
        LEFT JOIN intervention i ON c.NumeroClient = i.NumeroClient
        LEFT JOIN materiel m ON c.NumeroClient = m.NumeroClient
        WHERE c.NumeroClient = :numero_client"); // Utilisation de paramètres pour éviter les injections SQL

        $req->bindParam(":numero_client", $numero_client, PDO::PARAM_INT); // Liaison du paramètre

        $req->execute(); // Exécution de la requête
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats
        return $resultats; // Retourne les informations de la fiche client
    } catch (Exception $e) {
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour récupérer les informations de la fiche client (un seul résultat)
function getRechercheficheInfo($numero_client) {
    try {
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête SQL pour sélectionner les informations de la fiche client
        $req = $cnx->prepare("SELECT DISTINCT c.NumeroClient, c.RaisonSociale, c.Siren, c.CodeApe, c.Adresse, c.TelephoneClient, c.Email, c.DureeDeplacement, c.DistanceKm, c.NumeroAgence,
        cm.NumeroDeContrat, cm.DateSignature, cm.DateEcheance, cm.RefTypeContrat,
        i.NumeroIntervention, i.DateVisite, i.HeureVisite
        FROM client c
        LEFT JOIN contratdemaintenance cm ON c.NumeroClient = cm.NumeroClient
        LEFT JOIN intervention i ON c.NumeroClient = i.NumeroClient
        LEFT JOIN materiel m ON c.NumeroClient = m.NumeroClient
        WHERE c.NumeroClient = :numero_client"); // Utilisation de paramètres pour éviter les injections SQL

        $req->bindParam(":numero_client", $numero_client, PDO::PARAM_INT); // Liaison du paramètre

        $req->execute(); // Exécution de la requête
        $resultats = $req->fetch(PDO::FETCH_ASSOC); // Récupération d'un seul résultat
        return $resultats; // Retourne les informations de la fiche client
    } catch (Exception $e) {
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour récupérer les informations sur le matériel associé à un client
function getRecherchemateriel($numero_client) {
    try {
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête SQL pour sélectionner les informations sur le matériel associé à un client
        $req = $cnx->prepare("SELECT NumeroDeSerie, DateDeVente, DateInstallation, PrixDeVente, Emplacement, ReferenceInterne
        FROM `materiel`
        WHERE NumeroClient = :numero_client;");

        $req->bindParam(":numero_client", $numero_client, PDO::PARAM_INT); // Liaison du paramètre

        $req->execute(); // Exécution de la requête
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats
        return $resultats; // Retourne les informations sur le matériel
    }
    catch (Exception $e) {
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
?>
