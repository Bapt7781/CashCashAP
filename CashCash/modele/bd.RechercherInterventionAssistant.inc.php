<?php
include_once "bd.inc.php";

function getInterventionByDate($DateI){
    $resultat = array();
    
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE DateVisite = :DateI;");
        $req->bindValue(':DateI', $DateI, PDO::PARAM_STR);
    
        $req->execute();
        
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    } catch(PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat;
}

function getInterventionByMatricule($MatriculeTech){
    $resultat = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE Matricule = :NumTech;");
        $req->bindValue(':NumTech', $MatriculeTech, PDO::PARAM_INT);

        $req->execute();
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    }catch(PDOException $e){
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getInterventionByDateMatricule($dateIntervention,$numeroTechnicien){
    $resultat = array();
    try{
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT NumeroIntervention FROM intervention WHERE Matricule = :NumTech AND DateVisite = :DateI;");
        $req->bindValue(':NumTech', $numeroTechnicien, PDO::PARAM_INT);
        $req->bindValue(':DateI', $dateIntervention, PDO::PARAM_STR);

        $req->execute();
        while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
            $resultat[] = $ligne;
        }
    }catch(PDOException $e){
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getInformationIntervention($idIntervention) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT I.NumeroIntervention, I.DateVisite, I.HeureVisite, CT.NumeroClient, C.NumeroDeSerie, C.TempsPasse, C.Commentaire
                            FROM intervention I
                            JOIN controler C ON I.NumeroIntervention = C.NumeroIntervention
                            JOIN client CT ON I.NumeroClient = CT.NumeroClient
                            WHERE I.NumeroIntervention = :IdInter;");
        $req->bindValue(':IdInter', $idIntervention, PDO::PARAM_INT);
        $req->execute();

        // Vérifier si des données ont été trouvées
        if ($req->rowCount() == 0) {
            return null; // Aucune intervention trouvée avec cet identifiant
        }

        // Utiliser un tableau associatif pour stocker les informations sur les numéros de série
        $numerosSerie = array();

        // Afficher le formulaire prérempli
        echo "<h2>Modifier l'intervention :</h2>";
        echo "<form action='./?action=ValiderInformation' method='post'>";
        
        // Afficher une seule fois le numéro d'intervention, l'heure de visite et la date de visite
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        echo "<input type='hidden' name='numero_intervention' value='" . $resultat['NumeroIntervention'] . "'>";
        echo "Date de visite: <input type='date' name='date_visite' value='" . $resultat['DateVisite'] . "'><br>";
        echo "Heure de visite: <input type='time' name='heure_visite' value='" . $resultat['HeureVisite'] . "'><br>";

        // Continuer à afficher les autres numéros de série
        do {
            echo "Numéro du client: <input type='text' name='numero_client[]' value='" . $resultat['NumeroClient'] . "' readonly><br>";
            echo "Numéro de série du matériel: <input type='text' name='numero_serie[]' value='" . $resultat['NumeroDeSerie'] . "'><br>";
            echo "Temps passé: <input type='time' name='temps_passe[]' value='" . $resultat['TempsPasse'] . "'><br>";
            echo "Commentaire : <input type='text' name='commentaire[]' value='" . $resultat['Commentaire'] . "'><br>";
            
            // Stocker les numéros de série dans le tableau associatif
            $numerosSerie[$resultat['NumeroDeSerie']] = $resultat['NumeroClient'];

        } while ($resultat = $req->fetch(PDO::FETCH_ASSOC));

        // Stocker les numéros de série dans un champ masqué pour utilisation future
        echo "<input type='hidden' name='numeros_serie' value='" . json_encode($numerosSerie) . "'>";

        // Ajoutez d'autres champs selon votre structure de base de données

        echo "<button type='submit'>Valider les modifications</button>";
        // Ajouter l'espace entre les boutons
        echo "&nbsp;&nbsp;&nbsp;";
        
        // Ajouter le bouton Annuler qui recharge la page
        echo "<button type='button' onclick='window.location.reload();'>Annuler</button>";
        echo "</form>";

        return $resultat;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}



function updateInformationIntervention($idIntervention, $dateVisite, $heureVisite, $numerosSerie, $tempsPasse, $commentaires) {
    try {
        $cnx = connexionPDO();

        // Mettre à jour les informations de l'intervention
        $updateIntervention = $cnx->prepare("UPDATE intervention SET DateVisite = :dateVisite, HeureVisite = :heureVisite WHERE NumeroIntervention = :idIntervention");
        $updateIntervention->bindParam(':idIntervention', $idIntervention, PDO::PARAM_INT);
        $updateIntervention->bindParam(':dateVisite', $dateVisite, PDO::PARAM_STR);
        $updateIntervention->bindParam(':heureVisite', $heureVisite, PDO::PARAM_STR);
        $updateIntervention->execute();

        // Mettre à jour les informations des numéros de série
        foreach ($numerosSerie as $key => $numeroSerie) {
            $updateControler = $cnx->prepare("UPDATE controler SET TempsPasse = :tempsPasse, Commentaire = :commentaire WHERE NumeroIntervention = :idIntervention AND NumeroDeSerie = :numeroSerie");
            $updateControler->bindParam(':idIntervention', $idIntervention, PDO::PARAM_INT);
            $updateControler->bindParam(':numeroSerie', $key, PDO::PARAM_STR);
            $updateControler->bindParam(':tempsPasse', $tempsPasse[$key], PDO::PARAM_STR);
            $updateControler->bindParam(':commentaire', $commentaires[$key], PDO::PARAM_STR);
            $updateControler->execute();
        }

        return true; // Succès de la mise à jour

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        return false; // Échec de la mise à jour
    }
}








