<?php
// Vérifie si le rôle de l'utilisateur est défini
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}

// Vérifie si le rôle est défini et non vide
if (isset($role) && !empty($role)) {
    // Vérifie si le rôle est "assistant"
    if ($role == "assistant") { // Affichage ci-dessous si le rôle est assistant
        // Inclusion de l'entête de la vue
        include "$racine/vue/entete.php";
?>
        <!-- Titre de la page -->
        <title>Consulter les interventions</title>
        <!-- Lien vers la feuille de style CSS -->
        <link rel="stylesheet" href="./css/RechercheInt.css">

        <!-- Formulaire de recherche d'intervention -->
        <form class="form" action="./?action=RechercherIntervention" method="POST">
            <label for="Date_Intervention">Date intervention :</label>
            <input name="Date_Intervention" id="Date_Intervention" type="date"/>
            
            <!-- Titre OU -->
            <h3> OU </h3>

            <label for="Numero_Technicien">Numéro technicien :</label>
            <input name="Numero_Technicien" id="Numero_Technicien" type="number" min="1" placeholder="Ex : 1"/>

            <br>

            <!-- Bouton de recherche -->
            <button id="FORM" type="submit">Rechercher</button>
        </form>

        <!-- Vérifie si le formulaire a été soumis -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifie si des interventions ont été trouvées
            if (!empty($intervention)) {
                echo "<h2>Liste des interventions:</h2>";
                echo "<ul class='intervention-item'>";

                // Affichage des interventions trouvées
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
<?php } else{
    // Inclut le contrôleur de connexion pour les utilisateurs avec d'autres rôles que "assistant"
    include "$racine/controleur/connexion.php";
}
}else {
    // Inclut le contrôleur de connexion si le rôle n'est pas défini
    include "$racine/controleur/connexion.php";
}

?>
