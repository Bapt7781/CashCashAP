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

    function getMateriel(){
        try{
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT ReferenceInterne,LibelleTypeMateriel
            FROM `typemateriel`");
    
            $req->execute();
            $resultats = $req->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        }
        catch (Exception $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    function getContratClient($NumClient){
        try{
            $cnx = connexionPDO();
            $req = $cnx->prepare("SELECT NumeroDeContrat
            FROM `contratdemaintenance` WHERE NumeroClient = :NumClient");
            
            $req->bindValue(':NumClient', $NumClient, PDO::PARAM_INT);

            $resultats = $req->execute();

            return $resultats;
        }
        catch (Exception $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }






    function getModifInfoClient($donneesFormulaire){
        try{

            $cnx = connexionPDO();
            $req = $cnx->prepare("UPDATE client SET RaisonSociale = :RaisonSociale, Siren = :Siren, CodeApe = :CodeApe, Adresse = :Adresse, TelephoneClient = :TelephoneClient, Email = :Email, DureeDeplacement = :DureeDeplacement, DistanceKm = :DistanceKm,NumeroAgence = :NumeroAgence WHERE NumeroClient = :numeroClient");
            $req->bindValue(':numeroClient', $donneesFormulaire['numeroClient'], PDO::PARAM_INT);
            $req->bindValue(':RaisonSociale', $donneesFormulaire['RaisonSociale'], PDO::PARAM_STR);
            $req->bindValue(':Siren', $donneesFormulaire['Siren'], PDO::PARAM_INT);
            $req->bindValue(':CodeApe', $donneesFormulaire['CodeApe'], PDO::PARAM_INT);
            $req->bindValue(':Adresse', $donneesFormulaire['Adresse'], PDO::PARAM_STR);
            $req->bindValue(':TelephoneClient', $donneesFormulaire['TelephoneClient'], PDO::PARAM_STR);
            $req->bindValue(':Email', $donneesFormulaire['Email'], PDO::PARAM_STR);
            $req->bindValue(':DureeDeplacement', $donneesFormulaire['DureeDeplacement'], PDO::PARAM_STR);
            $req->bindValue(':DistanceKm', $donneesFormulaire['DistanceKm'], PDO::PARAM_STR);
            $req->bindValue(':NumeroAgence', $donneesFormulaire['NumeroAgence'], PDO::PARAM_INT);

            $result = $req->execute();
            if ($result) {
                $req2 = $cnx->prepare("UPDATE contratdemaintenance SET DateSignature = :DateSignature, DateEcheance = :DateEcheance, RefTypeContrat = :RefTypeContrat WHERE NumeroClient = :numeroClient AND NumeroDeContrat = :NumContrat");
                $req2->bindValue(':DateSignature', $donneesFormulaire['DateSignature'], PDO::PARAM_STR);
                $req2->bindValue(':DateEcheance', $donneesFormulaire['DateEcheance'], PDO::PARAM_STR);
                $req2->bindValue(':numeroClient', $donneesFormulaire['numeroClient'], PDO::PARAM_INT);
                $req2->bindValue(':NumContrat', $donneesFormulaire['NumContrat'], PDO::PARAM_INT);
                $req2->bindValue(':RefTypeContrat', $donneesFormulaire['RefTypeContrat'], PDO::PARAM_INT);
            
                $result2 = $req2->execute();

                if($result2){
                    $req3 = $cnx->prepare("UPDATE intervention SET DateVisite = :DateVisite, HeureVisite = :HeureVisite WHERE NumeroIntervention = :NumIntervention");
                    $req3->bindValue(':DateVisite', $donneesFormulaire['DateVisite'], PDO::PARAM_STR);
                    $req3->bindValue(':HeureVisite', $donneesFormulaire['HeureVisite'], PDO::PARAM_STR);
                    $req3->bindValue(':NumIntervention', $donneesFormulaire['NumIntervention'], PDO::PARAM_INT);

                    $result3 = $req3->execute();

                    echo '<script>';
                    if($result3){
                        echo 'alert("Fiche Client modifié avec succès ! Redirection vers la recherche...");';
                        echo 'window.location.href="?action=RechercheFiche";';
                    }else{
                        echo 'alert("Échec de la modification de la fiche client. Veuillez réessayer.");';
                        echo 'window.location.href="?action=RechercheFiche";';
                    }
                    
                }else{
                    echo 'alert("Échec de la modification de la fiche client. Veuillez réessayer.");';
                    echo 'window.location.href="?action=RechercheFiche";';
                }
            }else{
                echo 'alert("Échec de la modification de la fiche client. Veuillez réessayer.");';
                echo 'window.location.href="?action=RechercheFiche";';
            }
            echo '</script>';
        }catch (PDOException $e) {
            throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
        } catch (Exception $e) {
            // Notification JavaScript pour les erreurs
            echo '<script>';
            echo 'alert("' . $e->getMessage() . '");';
            echo 'window.location.href="?action=RechercherFiche";';
            echo '</script>';
        }
    }

    function getModifInfoClientMat($donneesFormulaire){
        try {
            $cnx = connexionPDO(); // Connexion à la base de données
            // Requête SQL pour sélectionner les informations sur le matériel associé à un client
            $req = $cnx->prepare("UPDATE materiel SET DateDeVente = :DateDeVente, DateInstallation = :DateInstallation, PrixDeVente = :PrixDeVente,Emplacement = :Emplacement WHERE NumeroDeSerie = :NumeroDeSerie");
    
            $req->bindParam(":NumeroDeSerie", $donneesFormulaire['numero_serie'], PDO::PARAM_INT);// Liaison du paramètre
            $req->bindParam(":DateDeVente", $donneesFormulaire['Date_de_vente'], PDO::PARAM_STR);// Liaison du paramètre
            $req->bindParam(":DateInstallation", $donneesFormulaire['Date_installation'], PDO::PARAM_STR);// Liaison du paramètre
            $req->bindParam(":Emplacement", $donneesFormulaire['Emplacement'], PDO::PARAM_STR);// Liaison du paramètre
            $req->bindParam(":PrixDeVente", $donneesFormulaire['Prix_de_vente'], PDO::PARAM_STR);// Liaison du paramètre
            
            
            
            $result = $req->execute(); // Exécution de la requête 
            echo '<script>';
            if($result){
                echo 'alert("Fiche Client modifié avec succès ! Redirection vers la recherche...");';
                echo 'window.location.href="?action=RechercheFiche";';
            }else{
                echo 'alert("Échec de la modification de la fiche client. Veuillez réessayer.");';
                echo 'window.location.href="?action=RechercheFiche";';
            }
            echo '</script>';
        }catch (PDOException $e) {
            throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
        } catch (Exception $e) {
            // Notification JavaScript pour les erreurs
            echo '<script>';
            echo 'alert("' . $e->getMessage() . '");';
            echo 'window.location.href="?action=RechercheFiche";';
            echo '</script>';
        }
    }

    
    function SuppressionControleIntervention($donneesFormulaire) {
        try {
            // Connexion à la base de données
            $cnx = connexionPDO();
    
            // Suppression du contrôle d'intervention
            $req = $cnx->prepare("DELETE FROM controler WHERE NumeroDeSerie = :NumeroDeSerie");
            $req->bindValue(':NumeroDeSerie', $donneesFormulaire['NumSerie'], PDO::PARAM_INT);
            $result = $req->execute();
            if($result){
                $req2 = $cnx->prepare("DELETE FROM materiel WHERE NumeroDeSerie = :NumeroDeSerie");
                $req2->bindValue(':NumeroDeSerie', $donneesFormulaire['NumSerie'], PDO::PARAM_INT);
    
                $result2 = $req2->execute();
                echo '<script>';
                if ($result2) {
                    echo 'alert("Contrôle supprimé avec succès ! Redirection vers la recherche...");';
                    echo 'window.location.href="?action=RechercheFiche";';
                } else {
                    echo 'alert("Échec de la suppression du contrôle. Veuillez réessayer.");';
                    echo 'window.location.href="?action=RechercheFiche";';
                }
            }
            // Notification JavaScript personnalisée
            else {
                echo 'alert("Échec de la suppression du contrôle. Veuillez réessayer.");';
                echo 'window.location.href="?action=RechercheFiche";';
            }
            echo '</script>';
    
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
        } catch (Exception $e) {
            // Notification JavaScript pour les erreurs
            echo '<script>';
            echo 'alert("' . $e->getMessage() . '");';
            echo 'window.location.href="?action=RechercheFiche";';
            echo '</script>';
        }
    }


    function ajouteMaterielClient($donneesFormulaire) {
        try {
            // Connexion à la base de données
            $cnx = connexionPDO();

            $req = $cnx->prepare("INSERT INTO `materiel` (`NumeroDeSerie`, `DateDeVente`, `DateInstallation`, `PrixDeVente`, `Emplacement`, `NumeroClient`, `NumeroDeContrat`, `ReferenceInterne`) VALUES (NULL, :DateDeVente, :DateInstallation, :PrixDeVente, :Emplacement, :NumeroClient, :NumeroDeContrat, :ReferenceInterne);");
            $req->bindValue(':DateDeVente', $donneesFormulaire['DateDeVente'], PDO::PARAM_STR);
            $req->bindValue(':DateInstallation', $donneesFormulaire['DateInstallation'], PDO::PARAM_STR);
            $req->bindValue(':PrixDeVente', $donneesFormulaire['PrixDeVente'], PDO::PARAM_STR);
            $req->bindValue(':Emplacement', $donneesFormulaire['Emplacement'], PDO::PARAM_STR);
            $req->bindValue(':NumeroClient', $donneesFormulaire['NumeroClient'], PDO::PARAM_INT);
            $req->bindValue(':NumeroDeContrat', $donneesFormulaire['NumeroDeContrat'], PDO::PARAM_INT);
            $req->bindValue(':ReferenceInterne', $donneesFormulaire['ReferenceInterne'], PDO::PARAM_INT);

    
            $result = $req->execute();
    
            // Notification JavaScript personnalisée
            echo '<script>';
            if ($result) {
                echo 'alert("Materiel ajouté avec succès ! Redirection vers la recherche...");';
                echo 'window.location.href="?action=RechercheFiche";';
            } else {
                echo 'alert("Échec de l\'ajout du Materiel. Veuillez réessayer.");';
                echo 'window.location.href="?action=RechercheFiche";';
            }
            echo '</script>';
    
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
        } catch (Exception $e) {
            // Notification JavaScript pour les erreurs
            echo '<script>';
            echo 'alert("' . $e->getMessage() . '");';
            echo 'window.location.href="?action=RechercheFiche";';
            echo '</script>';
        }
    }

?>
