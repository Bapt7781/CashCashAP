<?php
// Inclusion du fichier de connexion à la base de données
include_once "bd.inc.php";

// Vérification de la connexion à la base de données
VerificationConnexion();

// Fonction pour obtenir les interventions par date
function getInterventionByDate($DateI){
    $resultat = array();
    
    try {
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête préparée pour sélectionner les interventions par date
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE DateVisite = :DateI;");
        $req->bindValue(':DateI', $DateI, PDO::PARAM_STR); // Liaison du paramètre

        $req->execute(); // Exécution de la requête
        
        // Récupération des résultats
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    } catch(PDOException $e) {
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat; // Retourne le tableau de résultats
}

// Fonction pour obtenir les interventions par matricule technicien
function getInterventionByMatricule($MatriculeTech){
    $resultat = array();
    try{
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête préparée pour sélectionner les interventions par matricule technicien
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE Matricule = :NumTech;");
        $req->bindValue(':NumTech', $MatriculeTech, PDO::PARAM_INT); // Liaison du paramètre

        $req->execute(); // Exécution de la requête
        // Récupération des résultats
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    }catch(PDOException $e){
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat; // Retourne le tableau de résultats
}

// Fonction pour obtenir les interventions par date et matricule technicien
function getInterventionByDateMatricule($dateIntervention,$numeroTechnicien){
    $resultat = array();
    try{
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête préparée pour sélectionner les interventions par date et matricule technicien
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE Matricule = :NumTech AND DateVisite = :DateI;");
        $req->bindValue(':NumTech', $numeroTechnicien, PDO::PARAM_INT); // Liaison du paramètre
        $req->bindValue(':DateI', $dateIntervention, PDO::PARAM_STR); // Liaison du paramètre

        $req->execute(); // Exécution de la requête
        // Récupération des résultats
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    }catch(PDOException $e){
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour obtenir les informations d'une intervention
function getInformationIntervention($idIntervention) {
    try {
        $cnx = connexionPDO(); // Connexion à la base de données
        // Requête préparée pour sélectionner les informations d'une intervention
        $req = $cnx->prepare("SELECT I.NumeroIntervention, I.DateVisite, I.HeureVisite, CT.NumeroClient
                            FROM intervention I
                            JOIN client CT ON I.NumeroClient = CT.NumeroClient
                            WHERE I.NumeroIntervention = :IdInter;");
        $req->bindValue(':IdInter', $idIntervention, PDO::PARAM_INT); // Liaison du paramètre
        $req->execute(); // Exécution de la requête

        // Vérifier si des données ont été trouvées
        if ($req->rowCount() == 0) {
            return null; // Aucune intervention trouvée avec cet identifiant
        }

        $resultat = $req->fetch(PDO::FETCH_ASSOC); // Récupération des résultats

        return $resultat; // Retourne les informations de l'intervention

    } catch (PDOException $e) {
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

// Fonction pour obtenir les informations sur le matériel d'une intervention
function getInformationInterventionMateriel($idIntervention){
    try {
        $cnx = connexionPDO(); // Connexion à la base de données

        // Requête préparée pour sélectionner les informations sur le matériel d'une intervention
        $reqControles = $cnx->prepare("SELECT * FROM controler WHERE NumeroIntervention = :IdInter;");
        $reqControles->bindValue(':IdInter', $idIntervention, PDO::PARAM_INT); // Liaison du paramètre
        $reqControles->execute(); // Exécution de la requête
        $resultatControle = $reqControles->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats

        return $resultatControle; // Retourne les informations sur le matériel de l'intervention

    } catch (PDOException $e) {
        // Gestion des erreurs
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
?>
