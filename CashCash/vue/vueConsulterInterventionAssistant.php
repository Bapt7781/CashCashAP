<link rel="stylesheet" href="./css/vueConsulterInterventionAssistant.css">
<form class="form" action="./?action=RechercherIntervention" method="POST">
    <label for="Date_Intervention">Date intervention :</label>
    <input name="Date_Intervention" id="Date_Intervention" type="date"/>

    <h3> OU </h3>

    <label for="Numero_Technicien">Numéro technicien :</label>
    <input name="Numero_Technicien" id="Numero_Technicien" type="number" min="1" placeholder="Ex : 1"/>

    <br>

    <button type="submit">Rechercher</button>
</form>
<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez d'abord si le tableau n'est pas vide
    if (!empty($intervention)) {
        echo "<h2>Liste des interventions:</h2>";
        echo "<ul>";

        // Utilisez une boucle foreach pour parcourir le tableau
        foreach ($intervention as $ligne) {
            echo "<li>Numéro de l'intervention: " . $ligne['NumeroIntervention'] . "</li>";
            // Ajoutez d'autres éléments du tableau que vous souhaitez afficher
        }

        echo "</ul>";
    } else {
        echo "Aucune intervention trouvée pour la date spécifiée.";
    }
}
?>
