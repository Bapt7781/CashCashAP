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

        // Afficher le formulaire prérempli
        echo "<h2>Modifier l'intervention :</h2>";
        echo "<form action='./?action=ValiderInformation' method='post'>";

        // Section pour modifier l'heure, la date de visite et les informations du client
        echo "<h3>Modifier l'heure, la date de visite et les informations du client :</h3>";
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        echo "<input type='hidden' name='numero_intervention' value='" . $resultat['NumeroIntervention'] . "'>";
        echo "Date de visite: <input type='date' name='date_visite' value='" . $resultat['DateVisite'] . "'><br>";
        echo "Heure de visite: <input type='time' name='heure_visite' value='" . $resultat['HeureVisite'] . "'><br>";
        echo "Numéro du client: <input type='text' name='numero_client' value='" . $resultat['NumeroClient'] . "' readonly><br>";

        // Section pour modifier les numéros de série
        echo "<h3>Modifier les numéros de série :</h3>";
        $req->execute(); // Réexécuter la requête pour récupérer à nouveau les résultats
        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='controle-block'>";
            echo "Numéro de série du matériel: <input type='text' name='numero_serie[]' value='" . $resultat['NumeroDeSerie'] . "'><br>";
            echo "Temps passé: <input type='time' name='temps_passe[]' value='" . $resultat['TempsPasse'] . "'><br>";
            echo "Commentaire : <input type='text' name='commentaire[]' value='" . $resultat['Commentaire'] . "'><br>";
            echo "</div>";
        }

        // Ajouter un champ pour saisir un nouveau contrôle de matériel
        echo "<div id='nouveauControle'>";
        echo "<h3>Nouveau Contrôle de Matériel :</h3>";
        echo "Nouveau Numéro de série: <input type='text' name='nouveau_numero_serie[]'><br>";
        echo "Nouveau Temps passé: <input type='time' name='nouveau_temps_passe[]'><br>";
        echo "Nouveau Commentaire : <input type='text' name='nouveau_commentaire[]'><br>";
        echo "</div>";

        // Ajouter des boutons pour ajouter et soumettre le formulaire
        echo "<button type='button' id='ajouterControle' onclick='ajouterControle()'>Ajouter Contrôle</button><br>";
        echo "<button type='submit'>Valider les modifications</button>";

        // Ajouter le bouton Annuler qui recharge la page
        echo "<button type='button' onclick='window.location.reload();'>Annuler</button>";
        echo "</form>";

        return $resultat;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}











