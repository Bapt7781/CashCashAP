<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .calendrier {
      max-width: 400px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      color: #555;
    }

    select, input {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #2980b9;
    }

    #resultat {
      margin-top: 20px;
      padding: 15px;
      background-color: #ecf0f1;
      border-radius: 4px;
    }
  </style>
  <title>Sélection du Mois et de l'Année</title>
</head>
<body>
  <div class="calendrier">
    <h1>Sélection du Mois et de l'Année</h1>

    <form class="form" action="./?action=Statistiques" method="POST">
    <label for="mois">Mois :</label>
    <select id="mois">
      <option value="1">Janvier</option>
      <option value="2">Février</option>
      <option value="3">Mars</option>
      <option value="4">Avril</option>
      <option value="5">Mai</option>
      <option value="6">Juin</option>
      <option value="7">Juillet</option>
      <option value="8">Août</option>
      <option value="9">Septembre</option>
      <option value="10">Octobre</option>
      <option value="11">Novembre</option>
      <option value="12">Décembre</option>
    </select>

    <label for="annee">Année :</label>
    <input type="number" id="annee" min="1900" max="2100">

    <button onclick="afficherResultat()">Afficher les Interventions</button>

    <div id="resultat"></div>
    </form>
  </div>

  <script>
    function afficherResultat() {
      const mois = document.getElementById('mois').value;
      const annee = document.getElementById('annee').value;
      document.getElementById('resultat').innerHTML = resultatHTML;
    }
  </script>
</body>
</html>
