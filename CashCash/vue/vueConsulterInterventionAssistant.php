
<link rel="stylesheet" href="./css/RechercheInt.css">
<form class="form" action="./?action=RechercherIntervention" method="POST">
    <label for="Date_Intervention">Date intervention :</label>
    <input name="Date_Intervention" id="Date_Intervention" type="date"/>

    <h3> OU </h3>

    <label for="Numero_Technicien">Numéro technicien :</label>
    <input name="Numero_Technicien" id="Numero_Technicien" type="number" min="1" placeholder="Ex : 1"/>

    <br>

    <button id="FORM" type="submit">Rechercher</button>
</form>
<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($intervention)) {
        echo "<h2>Liste des interventions:</h2>";
        echo "<ul class='intervention-item'>";

        foreach ($intervention as $ligne) {
            echo "<li>";
            echo "Numéro de l'intervention: " . $ligne['NumeroIntervention'];

            // Bouton de modification
            echo "<form action='./?action=ModifierIntervention' method='post'>";
            echo "<input type='hidden' name='numero_intervention' value='" . $ligne['NumeroIntervention'] . "'>";
            echo "<button type='submit'>Modifier</button>";
            echo "</form>";

            echo "</li>";
        }

        echo "</ul>";
    } else {
        echo "Aucune intervention trouvée.";
    }
}
?>
