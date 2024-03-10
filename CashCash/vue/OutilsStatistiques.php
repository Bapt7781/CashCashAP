<?php
if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
}
if (isset($role) && !empty($role)) {
    if ($role == "assistant") { //Affichage ci-dessous si role = assistant
        include "$racine/vue/entete.php";
?>
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
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
    #resultat-container {
  margin-top: 20px;
  }

  .resultat-item {
    background-color: #fff;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }

  .resultat-item p {
    margin: 0;
  }
  .resultat-item table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
  }
  .resultat-item th, .resultat-item td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  .resultat-item th {
    background-color: #D3D3D3;;
    color: black;
  }

  .resultat-item tr:nth-child(even) {
    background-color: #F8F8FF;
  }
  </style>
  <title>Outil Statistiques</title>
</head>
<body>
  <div class="calendrier">
    <h1>Sélection du Mois et de l'Année</h1>

    <form class="form" action="./?action=Statistiques" method="POST">
    <label for="mois">Mois :</label>
    <select name="mois">
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
    <input type="text" name="annee" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="4">




    <button type="submit">Afficher les Interventions</button>

    <div id="resultat"></div>
    </form>
  </div>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mois = $_POST['mois'];
    $annee = $_POST['annee'];
    $dateDebut = $annee . '-' . str_pad($mois, 2, '0', STR_PAD_LEFT) . '-01';
    $dateFin = date('Y-m-t', strtotime($dateDebut));

    $Statistiques = getStatistiques($dateDebut, $dateFin);


    if (!empty($Statistiques)) {
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
        echo "<p>Aucun résultat trouvé.</p>";
    }
}
?>
</body>
</html>
<?php } else{
    include "$racine/controleur/connexion.php";
}
}else 
?>