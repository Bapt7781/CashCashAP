<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    $matricule = getMatriculeULoggedOn();
}

if (isset($role) && !empty($role)) {
    if ($role == "technicien") { // Affichage ci-dessous si le rôle est technicien
        include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des interventions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
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
$information = getInformationForTable($matricule);
$interventionsDejaAffichees = array(); // Tableau pour stocker les numéros d'intervention déjà affichés

foreach ($information as $uneLigne) {
    $numeroIntervention = $uneLigne["NumeroIntervention"];

    // Vérifier si l'intervention a déjà été affichée
    if (!in_array($numeroIntervention, $interventionsDejaAffichees)) {
?>
        <tr>
            <td><?php echo $numeroIntervention; ?></td>
            <td><?php echo $uneLigne["DistanceKm"]; ?></td>
            <td>
            <button type="button" class="btn btn-primary" 
            data-bs-toggle="modal" data-bs-target="#ValidationModal_<?php echo $numeroIntervention; ?>"
                >Valider</button>
            </td>        
        </tr>
        <div class="modal" tabindex="-1" id="ValidationModal_<?php echo $numeroIntervention; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Confirmation</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $informationForModal = getInformationForModal($numeroIntervention);
                        if (empty($informationForModal)){
                            ?>
                            <h5>Il n'y a aucun materiel à vérifier</h5>
                            <?php
                        }else { 
                            foreach ($informationForModal as $uneLigne){
                                echo "<h5>".$uneLigne['LibelleTypeMateriel']."</h5>";
                            ?>
                            <form method="post" action="./?action=ValiderInterventionSuccess">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Commentaire" id="floatingTextarea2" name="commentaire" style="height: 100px" maxlength="150"></textarea>
                                    <label for="floatingTextarea2">Commentaire</label>
                                </div>
                                <div class="cs-form mb-2">
                                    <label for="floatingInput">Temps passé</label>
                                    <input value="00:00:00" class="form-control" type="time" step="1" id="floatingInput" name="tempsPasse">
                                </div>
                                <input type="hidden" name="numeroIntervention" value="<?php echo $numeroIntervention; ?>">
                                <input type="hidden" name="numeroDeSerie" value="<?php echo $uneLigne['NumeroDeSerie']; ?>">
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
        // Ajouter le numéro d'intervention au tableau des interventions déjà affichées
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
        include "$racine/controleur/connexion.php";
    }
} else {
    include "$racine/controleur/connexion.php";
}
?>
