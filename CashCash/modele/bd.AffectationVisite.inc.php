<?php
// Inclusion du fichier de connexion à la base de données
include_once "bd.inc.php";

// Vérification de la connexion à la base de données
VerificationConnexion();

// Fonction pour récupérer les visites non affectées
function getVisitesNonAffec(){
    try{
        // Connexion à la base de données
        $cnx = connexionPDO();

        // Requête pour sélectionner les visites non affectées
        $req = $cnx->prepare("SELECT NumeroIntervention, DateVisite, HeureVisite, intervention.NumeroClient, NumeroAgence FROM intervention, client WHERE intervention.Matricule IS NULL AND intervention.NumeroClient = client.NumeroClient;");
        $req->execute();

        // Récupération des résultats
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;

    }catch(PDOException $e){
        // Gestion des exceptions PDO
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Gestion des autres exceptions avec notification JavaScript
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

// Fonction pour récupérer les visites affectées
function getVisitesAffec(){
    try{
        // Connexion à la base de données
        $cnx = connexionPDO();

        // Requête pour sélectionner les visites affectées
        $req = $cnx->prepare("SELECT NumeroIntervention, DateVisite, HeureVisite, intervention.NumeroClient, NumeroAgence FROM intervention, client WHERE intervention.Matricule IS NOT NULL AND intervention.NumeroClient = client.NumeroClient;");
        $req->execute();

        // Récupération des résultats
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;

    }catch(PDOException $e){
        // Gestion des exceptions PDO
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Gestion des autres exceptions avec notification JavaScript
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

// Fonction pour récupérer les techniciens d'une agence
function getTechVille($NumAgenceClient){
    try{
        // Connexion à la base de données
        $cnx = connexionPDO();

        // Requête pour sélectionner les techniciens d'une agence donnée
        $req = $cnx->prepare("SELECT NomEmploye, PrenomEmploye, employe.Matricule FROM employe, technicien, travailler WHERE employe.Matricule = technicien.Matricule AND technicien.Matricule = travailler.Matricule AND NumeroAgence = :NumAgenceClient;");
        $req->bindValue(':NumAgenceClient', $NumAgenceClient, PDO::PARAM_INT);
        $req->execute();

        // Récupération des résultats
        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;

    }catch(PDOException $e){
        // Gestion des exceptions PDO
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Gestion des autres exceptions avec notification JavaScript
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

// Fonction pour affecter une visite à un technicien
function AffecterVisite($donneesFormulaire){
    try{
        // Connexion à la base de données
        $cnx = connexionPDO();

        // Mise à jour de l'intervention avec le matricule du technicien
        $req = $cnx->prepare("UPDATE intervention SET Matricule = :Matricule WHERE NumeroIntervention = :NumInter ");
        $req->bindValue(':Matricule', $donneesFormulaire['NumTech'], PDO::PARAM_INT);
        $req->bindValue(':NumInter', $donneesFormulaire['NumIntervention'], PDO::PARAM_INT);

        // Exécution de la requête
        $resultats = $req->execute();

        // Notification JavaScript
        echo '<script>';
        if ($resultats) {
            echo 'alert("Affectation réussie !");';
            echo 'window.location.href="?action=AffecationVisite";';
        } else {
            echo 'alert("Échec de l\'affectation.");';
            echo 'window.location.href="?action=AffectationVisite";';
        }
        echo '</script>';

    }catch(PDOException $e){
        // Gestion des exceptions PDO
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Gestion des autres exceptions avec notification JavaScript
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=AffectationVisite";';
        echo '</script>';
    }
}
?>
