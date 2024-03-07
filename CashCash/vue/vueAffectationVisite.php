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
<link rel="stylesheet" href="./css/AffectVisit.css">
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
</head>
<body>
<h2>Liste des Visites Non Affectées</h2>
<?php
// Vérifiez si des visites non affectées ont été récupérées
if ($visitesNonAffec) {
    echo '<table border="1">';
    echo '<tr><th>Numéro Intervention</th><th>Date Visite</th><th>Heure Visite</th><th>Numéro Client</th></tr>';

    // Parcours du tableau des visites non affectées
    foreach ($visitesNonAffec as $visite) {
        echo '<tr>';
        echo '<td>' . $visite['NumeroIntervention'] . '</td>';
        echo '<td>' . $visite['DateVisite'] . '</td>';
        echo '<td>' . $visite['HeureVisite'] . '</td>';
        echo '<td>' . $visite['NumeroClient'] . '</td>';
        echo '<form>'?>
        
        <?php
        echo '</form>';
        echo '</tr>';
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
    echo '<tr><th>Numéro Intervention</th><th>Date Visite</th><th>Heure Visite</th><th>Numéro Client</th></tr>';

    // Parcours du tableau des visites non affectées
    foreach ($visitesAffec as $visite) {
        echo '<tr>';
        echo '<td>' . $visite['NumeroIntervention'] . '</td>';
        echo '<td>' . $visite['DateVisite'] . '</td>';
        echo '<td>' . $visite['HeureVisite'] . '</td>';
        echo '<td>' . $visite['NumeroClient'] . '</td>';
        ?>
        <td>
            <button class="download-btn" onclick="TelechargementPDF('<?= $visite['NumeroIntervention']; ?>')">Télécharger Fiche Intervention</button>
        </td>
        <?php
        echo '<form>'?>
        <script>
            function TelechargementPDF(NumeroIntervention) {
            }
        </script>
        <?php
        echo '</form>';
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