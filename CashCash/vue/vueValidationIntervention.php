<?php
// Vérifie si la variable de session "role" est définie
if (isset($_SESSION["role"])) {
    // Récupère le rôle depuis la session
    $role = $_SESSION["role"];
    // Appelle une fonction pour obtenir le matricule de l'utilisateur connecté
    $matricule = getMatriculeULoggedOn();
}

// Vérifie si la variable $role est définie et non vide
if (isset($role) && !empty($role)) {
    // Vérifie si le rôle est "technicien"
    if ($role == "technicien") { // Affichage ci-dessous si le rôle est technicien
        // Inclut le fichier d'en-tête de la page
        include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des interventions</title>
    <!-- Inclut les fichiers CSS et JavaScript de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<!-- Tableau pour afficher les informations -->
<table class="table m-5 mx-auto text-center" style="width: 80%">
    <thead>
        <tr>
            <th>Numéro d'intervention</th>
            <th>Distance de l'agence</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
// Appelle une fonction pour obtenir les informations pour remplir le tableau
$information = getInformationForTable($matricule);
// Tableau pour stocker les numéros d'intervention déjà affichés
$interventionsDejaAffichees = array();

// Parcours les informations récupérées
foreach ($information as $uneLigne) {
    $numeroIntervention = $uneLigne["NumeroIntervention"];

    // Vérifie si l'intervention n'a pas déjà été affichée
    if (!in_array($numeroIntervention, $interventionsDejaAffichees)) {
?>
        <!-- Affichage des informations dans une ligne du tableau -->
        <tr>
            <td><?php echo $numeroIntervention; ?></td>
            <td><?php echo $uneLigne["DistanceKm"]; ?></td>
            <td>
                <!-- Bouton pour ouvrir la modal de validation -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ValidationModal_<?php echo $numeroIntervention; ?>">Valider</button>
            </td>        
        </tr>
        <!-- Modal de validation pour chaque intervention -->
        <div class="modal" tabindex="-1" id="ValidationModal_<?php echo $numeroIntervention; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Confirmation</h3>
                        <!-- Bouton pour fermer la modal -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        // Appelle une fonction pour obtenir les informations spécifiques pour la modal
                        $informationForModal = getInformationForModal($numeroIntervention);
                        // Vérifie s'il y a des informations à afficher dans la modal
                        if (empty($informationForModal)){
                            ?>
                            <h5>Il n'y a aucun matériel à vérifier</h5>
                            <?php
                        } else { 
                            foreach ($informationForModal as $uneLigne){
                                // Affiche les informations sur le matériel à vérifier
                                echo "<h5>".$uneLigne['LibelleTypeMateriel']."</h5>";
                            ?>
                            <!-- Formulaire pour la validation de l'intervention -->
                            <form method="post" action="./?action=ValiderInterventionSuccess">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Commentaire" id="floatingTextarea2" name="commentaire" style="height: 100px" maxlength="150"></textarea>
                                    <label for="floatingTextarea2">Commentaire</label>
                                </div>
                                <div class="cs-form mb-2">
                                    <label for="floatingInput">Temps passé</label>
                                    <input value="00:00:00" class="form-control" type="time" step="1" id="floatingInput" name="tempsPasse">
                                </div>
                                <!-- Champ caché pour le numéro d'intervention -->
                                <input type="hidden" name="numeroIntervention" value="<?php echo $numeroIntervention; ?>">
                                <!-- Champ caché pour le numéro de série du matériel -->
                                <input type="hidden" name="numeroDeSerie" value="<?php echo $uneLigne['NumeroDeSerie']; ?>">
                                <!-- Bouton pour soumettre le formulaire -->
                                <div>
                                    <button type="submit" class="btn btn-success">Confirmer</button>
                                </div>
                            </form>
                                <br>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php
        // Ajoute le numéro d'intervention au tableau des interventions déjà affichées
        $interventionsDejaAffichees[] = $numeroIntervention;
    }
}

?>

    </tbody>
</table>
</body>
</html>
<?php
    } else {
        // Inclut le fichier de connexion si le rôle n'est pas "technicien"
        include "$racine/controleur/connexion.php";
    }
} else {
    // Inclut le fichier de connexion si le rôle n'est pas défini ou vide
    include "$racine/controleur/connexion.php";
}
?>
