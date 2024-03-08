<?php
include_once "bd.inc.php";

VerificationConnexion();


function getVisitesNonAffec(){
    try{
        $cnx = connexionPDO();

        $req = $cnx->prepare("SELECT NumeroIntervention,DateVisite,HeureVisite,intervention.NumeroClient,NumeroAgence from intervention,client where intervention.Matricule is NULL AND intervention.NumeroClient = client.NumeroClient;");
        $req->execute();

        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;

    }catch(PDOException $e){
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

function getVisitesAffec(){
    try{
        $cnx = connexionPDO();

        $req = $cnx->prepare("SELECT NumeroIntervention,DateVisite,HeureVisite,intervention.NumeroClient,NumeroAgence from intervention,client where intervention.Matricule is NOT NULL AND intervention.NumeroClient = client.NumeroClient;");
        $req->execute();

        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;

    }catch(PDOException $e){
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

function getTechVille($NumAgenceClient){
    try{
        $cnx = connexionPDO();

        $req = $cnx->prepare("SELECT NomEmploye,PrenomEmploye,employe.Matricule from employe,technicien,travailler where employe.Matricule = technicien.Matricule AND technicien.Matricule = travailler.Matricule AND NumeroAgence = :NumAgenceClient;");
        $req->bindValue(':NumAgenceClient', $NumAgenceClient, PDO::PARAM_INT);
        $req->execute();

        $resultats = $req->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;

    }catch(PDOException $e){
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}


function AffecterVisite($donneesFormulaire){
    try{
        $cnx = connexionPDO();

        $req = $cnx->prepare("UPDATE intervention SET Matricule = :Matricule WHERE NumeroIntervention = :NumInter ");
        $req->bindValue(':Matricule', $donneesFormulaire['NumTech'], PDO::PARAM_INT);
        $req->bindValue(':NumInter', $donneesFormulaire['NumIntervention'], PDO::PARAM_INT);

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
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=AffectationVisite";';
        echo '</script>';
    }
}
?>