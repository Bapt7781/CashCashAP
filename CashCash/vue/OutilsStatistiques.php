<?php
// Vérifie si la session contient une variable "role"
if (isset($_SESSION["role"])) {
  // Si oui, récupère la valeur de la variable "role" de la session
  $role = $_SESSION["role"];
}

// Vérifie si la variable $role est définie et non vide
if (isset($role) && !empty($role)) {
    // Si le rôle est "assistant", inclut l'en-tête et commence la page HTML
    if ($role == "assistant") {
        // Inclusion de l'en-tête
        include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/OutilsStatistiques.css">
  <title>Outil Statistiques</title>
</head>
<body>
  <div class="calendrier">
    <h1>Sélection du Mois et de l'Année</h1>

    <!-- Formulaire pour sélectionner un mois et une année -->
    <form class="form" action="./?action=Statistiques" method="POST">
    <label for="mois">Mois :</label>
    <select name="mois">
        <option value="1">Janvier</option>
        <option value="2">Février</option>
        <!-- Options pour les autres mois... -->
    </select>

    <label for="annee">Année :</label>
    <input type="text" name="annee" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="4">

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit">Afficher les Interventions</button>

    <!-- Div pour afficher les résultats -->
    <div id="resultat"></div>
    </form>
  </div>

  <?php
    // Vérifie si la méthode de requête est POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupère le mois et l'année envoyés via le formulaire
        $mois = $_POST['mois'];
        $annee = $_POST['annee'];
        // Définit la date de début du mois et la date de fin du mois
        $dateDebut = $annee . '-' . str_pad($mois, 2, '0', STR_PAD_LEFT) . '-01';
        $dateFin = date('Y-m-t', strtotime($dateDebut));

        // Appelle la fonction getStatistiques pour obtenir les statistiques
        $Statistiques = getStatistiques($dateDebut, $dateFin);

        // Vérifie si des statistiques ont été trouvées
        if (!empty($Statistiques)) {
            // Affiche les statistiques sous forme de tableaux
            foreach ($Statistiques as $uneLigne) {
                echo "<div class='resultat-item'>";
                echo "<table>";
                echo "<tr><th>Nom prénom employé</th><th>Nombre d'interventions réalisées</th><th>Nombre total de kilomètres parcourus</th><th>Durée passée au contrôle du matériel</th></tr>";
                echo "<tr>";
                echo "<td>" . $uneLigne["NomEmploye"] . " " . $uneLigne["PrenomEmploye"] . "</td>";
                echo "<td>" . $uneLigne["NombreInterventions"] . "</td>";
                echo "<td>" . $uneLigne["DistanceTotaleKm"] . "</td>";
                echo "<td>" . $uneLigne["TempsTotalPasse"] . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "</div>";
            }
        } else {
            // Si aucune statistique n'a été trouvée, affiche un message approprié
            echo "<p>Aucun résultat trouvé.</p>";
        }
    }
  ?>
</body>
</html>
<?php } else{
    // Si le rôle n'est pas "assistant", inclut le fichier de connexion
    include "$racine/controleur/connexion.php";
}
}else {
    // Si le rôle n'est pas défini ou vide dans la session, ne fait rien
}
?>
