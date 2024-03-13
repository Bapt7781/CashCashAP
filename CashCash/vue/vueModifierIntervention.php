<?php
if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") { // Affichage ci-dessous si le rôle est assistant
        include "$racine/vue/entete.php";
?>
        <title>Modification interventions</title>
        <link rel="stylesheet" href="./css/ModifierInter.css">
        <br><br><br>
        
        <form action='./?action=ValiderInformation' method='post' id="page">
            <h3>Modifier l'heure, la date de visite et les informations du client :</h3>
            <input type='hidden' name='action' value='modifier'>
            <input type='hidden' name='numero_intervention' value='<?php echo $modification['NumeroIntervention']; ?>'>
            Date de visite: <input type='date' name='date_visite' value='<?php echo $modification['DateVisite']; ?>'> <br>
            Heure de visite: <input type='time' name='heure_visite' value='<?php echo $modification['HeureVisite'];  ?>'> <br>
            Numéro du client: <input type='number' name='numero_client' value='<?php echo $modification['NumeroClient']; ?>'><br>
            <button type='submit'>Valider les modifications</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type='button' class='cancel-button' onclick='window.location.reload();'>Annuler</button>
        </form><br><br><br><br>
        
        <?php
        foreach ($InformationMateriel as $controle) {
        ?>
            <form action='./?action=ValiderInformation' method='post' id="page2">
                <h3>Contrôle de Matériel :</h3>
                <input type='hidden' name='action' value='MaterielModif'>
                <input type='hidden' name='numero_intervention' value='<?php echo $controle['NumeroIntervention']; ?>'>
                <input type='hidden' name='controle_numero_serieAc' value='<?php echo $controle['NumeroDeSerie']; ?>'>
                Numéro de série du matériel: <input type='number' name='controle_numero_serieNv' value='<?php echo $controle['NumeroDeSerie'] ?>'><br>
                Temps passé: <input type='time' step='1' name='controle_temps_passe' value='<?php echo $controle['TempsPasse'] ?>'><br>
                Commentaire : <input type='text' name='controle_commentaire' value='<?php echo $controle['Commentaire'] ?>'><br>
                <button type='submit'>Modifier le contrôle de matériel</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <button type='button' class='supp-button' onclick="deleteControle()">Supprimer</button>
                <input type='hidden' name='supprimer' value='true'>
            </form>

            <script>
                function deleteControle() {
                    if (confirm("Voulez-vous vraiment supprimer ce matériel ?")) {
                        // Ajouter un input supplémentaire pour indiquer la suppression
                        var form = document.getElementById('page2');
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'action';
                        input.value = 'Supp';
                        form.appendChild(input);

                        // Soumettre le formulaire
                        form.submit();
                    }
                }
            </script>

            <br>
        <?php } ?>

        <br><br><br><br>
        <form action='./?action=ValiderInformation' method='post' id="page">
            <h3>Nouveau Contrôle de Matériel :</h3>
            <input type='hidden' name='action' value='ajouter'>
            <input type='hidden' name='numero_intervention' value='<?php echo $modification['NumeroIntervention']; ?>'>
            Numéro de série du matériel: <input type='number' name='nouveau_numero_serie'><br>
            Temps passé: <input type='time' step='1' name='nouveau_temps_passe'><br>
            Commentaire : <input type='text' name='nouveau_commentaire'><br>
            <button type='submit' onclick='window.location.reload();'>Ajouter le contrôle</button>
        </form>

<?php
    } else {
        include "$racine/controleur/connexion.php";
    }
} else {
    include "$racine/controleur/connexion.php";
}
?>
