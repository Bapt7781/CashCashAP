<?php

VerificationConnexion();

function ValiderInformationIntervention($donneesFormulaire) {
    try {
        //Connexion BDD
        $cnx = connexionPDO();
        
        // Vérifiez si les données soumises sont présentes et correctes
        if (!isset($donneesFormulaire['numero_intervention'])) {
            throw new Exception("Données invalides : numéro d'intervention manquant.");
        }
        if (!numeroClientExiste($cnx, $donneesFormulaire['numero_client'])) {
            throw new Exception("Numéro client invalide : le numéro client n'existe pas.");
        }


        // Mise à jour de la date de visite, de l'heure et du numéro du client
        $req = $cnx->prepare("UPDATE intervention SET DateVisite = :NewDateI, HeureVisite = :NewHeure, NumeroClient = :NewNumeroClient WHERE NumeroIntervention = :NumIntervention;");
        $req->bindValue(':NewDateI', $donneesFormulaire['date_visite'], PDO::PARAM_STR);
        $req->bindValue(':NewHeure', $donneesFormulaire['heure_visite'], PDO::PARAM_STR);
        $req->bindValue(':NewNumeroClient', $donneesFormulaire['numero_client'], PDO::PARAM_INT);
        $req->bindValue(':NumIntervention', $donneesFormulaire['numero_intervention'], PDO::PARAM_INT);

        $result = $req->execute();

        // Notification JavaScript
        echo '<script>';
        if ($result) {
            echo 'alert("Modification réussie !");';
            echo 'window.location.href="?action=RechercherIntervention";';
        } else {
            echo 'alert("Échec de la modification.");';
            echo 'window.location.href="?action=RechercherIntervention";';
        }
        echo '</script>';

    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

function numeroClientExiste($cnx, $numeroClient) {
    $req = $cnx->prepare("SELECT COUNT(*) FROM client WHERE NumeroClient = :NumeroClient;");
    $req->bindValue(':NumeroClient', $numeroClient, PDO::PARAM_INT);
    $req->execute();
    $count = $req->fetchColumn();
    return ($count > 0);
}


function numeroClientCorrespondMateriel($cnx, $numeroClient,$numeroSerie) {
    $req = $cnx->prepare("SELECT COUNT(*) FROM materiel WHERE NumeroDeSerie = :NumeroSerie AND NumeroClient = :NumeroClient");
    $req->bindValue(':NumeroClient', $numeroClient,PDO::PARAM_INT);
    $req->bindValue(':NumeroSerie', $numeroSerie,PDO::PARAM_INT);
    $req->execute();
    $count = $req->fetchColumn();
    $drapeau = false;
    if($count > 0 ){
        $drapeau = true;
    }
    return $drapeau;
}
function DonneNumeroClient($cnx, $NumeroIntervention) {
    $req = $cnx->prepare("SELECT NumeroClient FROM intervention WHERE NumeroIntervention = :NumeroIntervention");
    $req->bindValue(':NumeroIntervention', $NumeroIntervention, PDO::PARAM_INT);
    $req->execute();
    
    $resultat = $req->fetch(PDO::FETCH_ASSOC);

    if ($resultat) {
        return $resultat['NumeroClient'];
    } else {
        return false;
    }
}


function ajouteControleIntervention($donneesFormulaire) {
    try {
        //Connexion BDD
        $cnx = connexionPDO();
        
        // Vérifiez si les données soumises sont présentes et correctes
        if (!isset($donneesFormulaire['NumeroIntervention'])) {
            throw new Exception("Données invalides : numéro d'intervention manquant.");
        }
        $numeroClientIntervention = DonneNumeroClient($cnx, $donneesFormulaire['NumeroIntervention']);
        if (numeroClientCorrespondMateriel($cnx, $numeroClientIntervention, $donneesFormulaire['NumeroDeSerie']) == false) {
            throw new Exception("Numéro Serie invalide : le numéro de série n'appartient pas au client saisi.");
        }

        $req = $cnx->prepare("INSERT INTO controler(NumeroDeSerie,NumeroIntervention,TempsPasse,Commentaire) VALUES(:NewNumeroDeSerie, :NumeroIntervention, :NewTempsPasse, :Commentaire)");
        $req->bindValue(':NewNumeroDeSerie', $donneesFormulaire['NumeroDeSerie'], PDO::PARAM_INT);
        $req->bindValue(':NumeroIntervention', $donneesFormulaire['NumeroIntervention'], PDO::PARAM_INT);
        $req->bindValue(':NewTempsPasse', $donneesFormulaire['TempsPasse'], PDO::PARAM_STR);
        $req->bindValue(':Commentaire', $donneesFormulaire['Commentaire'], PDO::PARAM_STR);

        $result = $req->execute();

        // Notification JavaScript personnalisée
        echo '<script>';
        if ($result) {
            echo 'alert("Contrôle ajouté avec succès ! Redirection vers la recherche...");';
            echo 'window.location.href="?action=RechercherIntervention";';
        } else {
            echo 'alert("Échec de l\'ajout du contrôle. Veuillez réessayer.");';
            echo 'window.location.href="?action=RechercherIntervention";';
        }
        echo '</script>';

    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}


function ModificationControleIntervention($donneesFormulaire){
    try{
        //Connexion BDD
        $cnx = connexionPDO();
    
        // Vérifiez si les données soumises sont présentes et correctes
        if (!isset($donneesFormulaire['NumeroIntervention'])) {
            throw new Exception("Données invalides : numéro d'intervention manquant.");
        }
        $numeroClientIntervention = DonneNumeroClient($cnx, $donneesFormulaire['NumeroIntervention']);
        if (numeroClientCorrespondMateriel($cnx, $numeroClientIntervention, $donneesFormulaire['NouveauNumSerie']) == false) {
            throw new Exception("Numéro Serie invalide : le numéro de série n'appartient pas au client saisi.");
        }


        $req = $cnx->prepare("UPDATE controler SET 
                                NumeroDeSerie = :NouveauNumSerie, 
                                Commentaire = :Commentaire, 
                                TempsPasse = :TempsPasse 
                                WHERE NumeroDeSerie = :AncienNumSerie AND NumeroIntervention = :NumeroIntervention");
        $req->bindValue(':NouveauNumSerie', $donneesFormulaire['NouveauNumSerie'], PDO::PARAM_INT);
        $req->bindValue(':Commentaire', $donneesFormulaire['Commentaire'], PDO::PARAM_STR);
        $req->bindValue(':TempsPasse', $donneesFormulaire['TempsPasse'], PDO::PARAM_STR);
        $req->bindValue(':AncienNumSerie', $donneesFormulaire['AncienNumSerie'], PDO::PARAM_INT);
        $req->bindValue(':NumeroIntervention', $donneesFormulaire['NumeroIntervention'], PDO::PARAM_INT);


        $result = $req->execute();

        // Notification JavaScript personnalisée
        echo '<script>';
        if ($result) {
            echo 'alert("Contrôle modifié avec succès ! Redirection vers la recherche...");';
            echo 'window.location.href="?action=RechercherIntervention";';
        } else {
            echo 'alert("Échec de la modification du contrôle. Veuillez réessayer.");';
            echo 'window.location.href="?action=RechercherIntervention";';
        }
        echo '</script>';

    }catch(PDOException $e){
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    }catch(Exception $e){
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

function SuppressionControleIntervention($donneesFormulaire) {
    try {
        // Connexion à la base de données
        $cnx = connexionPDO();

        // Vérifiez si les données soumises sont présentes et correctes
        if (!isset($donneesFormulaire['NumeroIntervention'])) {
            throw new Exception("Données invalides : numéro d'intervention manquant.");
        }

        $numeroClientIntervention = DonneNumeroClient($cnx, $donneesFormulaire['NumeroIntervention']);
        
        // Suppression du contrôle d'intervention
        $req = $cnx->prepare("DELETE FROM controler WHERE NumeroDeSerie = :NumeroDeSerie AND NumeroIntervention = :NumeroIntervention");
        $req->bindValue(':NumeroDeSerie', $donneesFormulaire['NumSerie'], PDO::PARAM_INT);
        $req->bindValue(':NumeroIntervention', $donneesFormulaire['NumeroIntervention'], PDO::PARAM_INT);

        $result = $req->execute();

        // Notification JavaScript personnalisée
        echo '<script>';
        if ($result) {
            echo 'alert("Contrôle supprimé avec succès ! Redirection vers la recherche...");';
            echo 'window.location.href="?action=RechercherIntervention";';
        } else {
            echo 'alert("Échec de la suppression du contrôle. Veuillez réessayer.");';
            echo 'window.location.href="?action=RechercherIntervention";';
        }
        echo '</script>';

    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        // Notification JavaScript pour les erreurs
        echo '<script>';
        echo 'alert("' . $e->getMessage() . '");';
        echo 'window.location.href="?action=RechercherIntervention";';
        echo '</script>';
    }
}

?>
