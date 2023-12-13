<link rel="stylesheet" href="../css/vueConsulterInterventionAssistant.css">
<form class="form" action="./?action=RechercherIntervention" method="POST">
    <label for="Date_Intervention">Date intervention :</label>
    <input name="Date_Intervention" id="Date_Intervention" type="date"/>

    <h3> OU </h3>

    <label for="Numero_Technicien">Numéro technicien :</label>
    <input name="Numero_Technicien" id="Numero_Technicien" type="number" min="1" placeholder="Ex : 1"/>

    <br>

    <button type="submit">Rechercher</button>
</form>
