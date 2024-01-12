<?php
function ValiderInformationIntervention($donneesFormulaire) {
    try {
        // Connectez-vous à la base de données
        $cnx = connexionPDO();
        
        // Vérifiez si les données soumises sont présentes
        if (!isset($donneesFormulaire['numero_intervention'])) {
            throw new Exception("Données invalides : numéro d'intervention manquant.");
        }

        // Vérifiez si le numéro client existe dans la base de données
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

        // Notification HTML
        $notification = '<div class="message-box">';
        if ($result) {
            $notification .= '<span class="success">Modification réussie !</span>';
        } else {
            $notification .= '<span class="error">Échec de la modification.</span>';
        }
        $notification .= '</div>';

    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        $notification = '<div class="message-box"><span class="error">' . $e->getMessage() . '</span></div>';
    }

    // Début du HTML
    echo '<!DOCTYPE html>';
    echo '<html lang="fr">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<style>';
    echo 'body {font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f0f0f0;}';
    echo '.message-box {padding: 20px; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 5px; text-align: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);}';
    echo '.success {color: green;}';
    echo '.error {color: red;}';
    echo '.return-button {position: absolute; top: 10px; left: 10px; padding: 10px 20px; background-color: #4caf50; color: white; text-decoration: none; border-radius: 5px;}';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    // Bouton de retour en haut à gauche
    echo '<a href="?action=RechercherIntervention" class="return-button">Retourner à Rechercher Intervention</a>';

    // Affichage de la notification
    echo $notification;

    // Fin du HTML
    echo '</body>';
    echo '</html>';
}
function numeroClientExiste($cnx, $numeroClient) {
    $req = $cnx->prepare("SELECT COUNT(*) FROM client WHERE NumeroClient = :NumeroClient;");
    $req->bindValue(':NumeroClient', $numeroClient, PDO::PARAM_INT);
    $req->execute();
    $count = $req->fetchColumn();
    return ($count > 0);
}


function numeroClientCorrespondMateriel($cnx, $numeroClient,$numeroSerie) {
    $req = $cnx->prepare("SELECT COUNT(*) FROM materiel WHERE NumeroDeSerie = :NumeroSerie AND NumeroClient = :NumeroClient;");
    $req->bindValue(':NumeroClient', $numeroClient,PDO::PARAM_INT);
    $req->bindValue(':NumeroSerie', $numeroSerie,PDO::PARAM_INT);
    $req->execute();
    $count = $req->fetchColumn();
    return ($count > 0);
}
function DonneNumeroClient($cnx,$NumeroIntervention){
    $req = $cnx->prepare("SELECT NumeroClient FROM intervention WHERE NumeroIntervention = :NumeroIntervention");
    $req->bindValue(':NumeroIntervention',$NumeroIntervention,PDO::PARAM_INT);
    $req->execute();
    return $req;
}

function ajouteControleIntervention($donneesFormulaire){
    try{
        // Connectez-vous à la base de données
        $cnx = connexionPDO();
        
        // Vérifiez si les données soumises sont présentes
        if (!isset($donneesFormulaire['NumeroIntervention'])) {
            throw new Exception("Données invalides : numéro d'intervention manquant.");
        }
        $numeroClientIntervention = DonneNumeroClient($cnx, $donneesFormulaire['NumeroIntervention']);

        if(numeroClientCorrespondMateriel($cnx, $numeroClientIntervention, $donneesFormulaire['NumeroDeSerie']) == FALSE) {
            throw new Exception("Numéro Serie invalide : le numéro de série n'appartient pas au client saisi.");
        }

        $req = $cnx->prepare("INSERT INTO controler(NumeroDeSerie,NumeroIntervention,TempsPasse,Commentaire) VALUES(:NewNumeroDeSerie, :NumeroIntervention, :NewTempsPasse, :Commentaire)");
        $req->bindValue(':NewNumeroDeSerie', $donneesFormulaire['NumeroDeSerie'], PDO::PARAM_INT);
        $req->bindValue(':NumeroIntervention', $donneesFormulaire['NumeroIntervention'], PDO::PARAM_INT);
        $req->bindValue(':NewTempsPasse', $donneesFormulaire['TempsPasse'], PDO::PARAM_STR);
        $req->bindValue(':Commentaire', $donneesFormulaire['Commentaire'], PDO::PARAM_STR);

        $result = $req->execute();


         // Notification HTML
        $notification = '<div class="message-box">';
        if ($result) {
             $notification .= '<span class="success">Ajout du contrôle effectuée !</span>';
        } else {
            $notification .= '<span class="error">Échec du nouveaux controle ajouté.</span>';
        }
        $notification .= '</div>';

    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
    } catch (Exception $e) {
        $notification = '<div class="message-box"><span class="error">' . $e->getMessage() . '</span></div>';
    }
    // Début du HTML
    echo '<!DOCTYPE html>';
    echo '<html lang="fr">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<style>';
    echo 'body {font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f0f0f0;}';
    echo '.message-box {padding: 20px; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 5px; text-align: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);}';
    echo '.success {color: green;}';
    echo '.error {color: red;}';
    echo '.return-button {position: absolute; top: 10px; left: 10px; padding: 10px 20px; background-color: #4caf50; color: white; text-decoration: none; border-radius: 5px;}';
    echo '</style>';
    echo '</head>';
    echo '<body>';

    // Bouton de retour en haut à gauche
    echo '<a href="?action=RechercherIntervention" class="return-button">Retourner à Rechercher Intervention</a>';

    // Affichage de la notification
    echo $notification;

    // Fin du HTML
    echo '</body>';
    echo '</html>';
}
?>
