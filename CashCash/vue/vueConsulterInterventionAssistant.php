<style>
    .form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 5%;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }

    h3 {
        text-align: center;
        margin: 20px 0;
    }

    button {
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<form class="form" action="../modele/bd.Intervention" method="post">
    <label for="Date_Intervention">Date intervention :</label>
    <input name="Date_Intervention" id="Date_Intervention" type="date"/>

    <h3> OU </h3>

    <label for="Numero_Technicien">Numéro technicien :</label>
    <input name="Numero_Technicien" id="Numero_Technicien" type="number" min="1" placeholder="Ex : 1"/>

    <br>

    <button type="submit">Rechercher</button>
</form>
