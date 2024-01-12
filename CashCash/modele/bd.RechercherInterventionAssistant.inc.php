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
        $req = $cnx->prepare("SELECT I.NumeroIntervention, I.DateVisite, I.HeureVisite, CT.NumeroClient
                            FROM intervention I
                            JOIN client CT ON I.NumeroClient = CT.NumeroClient
                            WHERE I.NumeroIntervention = :IdInter;");
        $req->bindValue(':IdInter', $idIntervention, PDO::PARAM_INT);
        $req->execute();

        // Vérifier si des données ont été trouvées
        if ($req->rowCount() == 0) {
            return null; // Aucune intervention trouvée avec cet identifiant
        }

        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // Afficher le formulaire prérempli
        echo "<form action='./?action=ValiderInformation' method='post'>";

        // Section pour modifier l'heure, la date de visite et les informations du client
        echo "<h3>Modifier l'heure, la date de visite et les informations du client :</h3>";
        echo "<input type='hidden' name='action' value='modifier'>";
        echo "<input type='hidden' name='numero_intervention' value='" . $resultat['NumeroIntervention'] . "'>";
        echo "Date de visite: <input type='date' name='date_visite' value='" . $resultat['DateVisite'] . "'><br>";
        echo "Heure de visite: <input type='time' name='heure_visite' value='" . $resultat['HeureVisite'] . "'><br>";
        echo "Numéro du client: <input type='number' name='numero_client' value='" . $resultat['NumeroClient'] . "'><br>";


        echo "<button type='submit'>Valider les modifications</button>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

        echo "<button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>";
        echo "</form><br><br><br><br>";?>
        <style>.cancel-button {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .cancel-button:hover {
            background-color: #b02a37;
        }</style>
        <?php

        echo "<form action='./?action=ValiderInformation' method='post'>";
        echo "<h3>Nouveau Contrôle de Matériel :</h3>";
        echo "<input type='hidden' name='action' value='ajouter'>";
        echo "<input type='hidden' name='numero_intervention' value='" . $resultat['NumeroIntervention'] . "'>";
        echo "Numéro de série du client: <input type='number' name='nouveau_numero_serie'><br>";
        echo "Temps passé: <input type='time' name='nouveau_temps_passe'><br>";
        echo "Commentaire : <input type='text' name='nouveau_commentaire'><br>";
        echo "<button type='submit'>Ajouter le contrôle</button>";
        echo "</form>";

        return $resultat;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}












