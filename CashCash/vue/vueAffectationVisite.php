<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") { //Affichage ci-dessous si role = assistant
        include "$racine/vue/entete.php";
        
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" href="./css/AffectationVisite.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<h2>Liste des Visites Non Affectées</h2>
<?php
// Vérifiez si des visites non affectées ont été récupérées
if ($visitesNonAffec) {
    echo '<table border="1">';
    echo '<tr><th>Numéro Intervention</th><th>Date Visite</th><th>Heure Visite</th><th>Numéro Client</th><th>Affecter Visite</th></tr>';

    // Parcours du tableau des visites non affectées
    foreach ($visitesNonAffec as $visite) {
        echo '<tr>';
        echo '<td>' . $visite['NumeroIntervention'] . '</td>';
        echo '<td>' . $visite['DateVisite'] . '</td>';
        echo '<td>' . $visite['HeureVisite'] . '</td>';
        echo '<td>' . $visite['NumeroClient'] . '</td>';
        
        $Technicien = getTechVille($visite['NumeroAgence'])
        ?>

        

        <td><button type="button" class="act btn-primary" 
            data-bs-toggle="modal" data-bs-target="#ValidationModal_<?php echo $visite['NumeroIntervention']; ?>"
            >Affecter</button></td>

            <div class="modal fade" id="ValidationModal_<?php echo $visite['NumeroIntervention'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Affectation Visite</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="./?action=AffectationVisite">
                            <input type='hidden' name='action' value='affecter'>
                                <div class="mb-3">
                                    <label for="technicien" class="form-label">Sélectionnez un technicien :</label>
                                    <select class="form-select" name="technicien" id="technicien" required>
                                        <?php
                                        foreach ($Technicien as $unTech) {
                                            echo "<option value='{$unTech['Matricule']}'>{$unTech['PrenomEmploye']} {$unTech['NomEmploye']} (Matricule : {$unTech['Matricule']})</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" name="numeroIntervention" value="<?php echo $visite['NumeroIntervention'] ?>">
                                <div class="mb-3">
                                    <button type="submit" class="act btn-success">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </tr>
        <?php
    }

    echo '</table>';
} else {
    echo '<p>Aucune visite non affectée trouvée.</p>';
}
?>
<h2>Visites affectées</h2>
<?php
// Vérifiez si des visites non affectées ont été récupérées
if ($visitesAffec) {
    echo '<table border="1">';
    echo '<tr><th>Numéro Intervention</th><th>Date Visite</th><th>Heure Visite</th><th>Numéro Client</th><th>Fiche Intervention</th></tr>';

    // Parcours du tableau des visites non affectées
    foreach ($visitesAffec as $visite) {
        echo '<tr>';
        echo '<td>' . $visite['NumeroIntervention'] . '</td>';
        echo '<td>' . $visite['DateVisite'] . '</td>';
        echo '<td>' . $visite['HeureVisite'] . '</td>';
        echo '<td>' . $visite['NumeroClient'] . '</td>';
        ?>
        <td>
        <a href="./PDF.php?NumeroIntervention=<?php echo $visite['NumeroIntervention']; ?>&NumeroClient=<?php echo $visite['NumeroClient']; ?>">Télécharger</a>
        </td>
        
        
        <?php
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>Aucune visite affectée trouvée.</p>';
}
?>
</body>
</html>
<?php } else{
    include "$racine/controleur/connexion.php";
}
}else {
    include "$racine/controleur/connexion.php";
}

?>