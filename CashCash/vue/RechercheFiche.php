<?php
include "$racine/vue/entete.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align:center;
            
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 435px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        input {
            width: calc(100% - 12px);
            padding: 10px;
            margin: 6px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color:#007BFF;
            color: white;
            padding: 10px 174px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color:#0056b3;
        }

        .client-list {
            list-style-type: none;
            padding: 0;
        }

        .client-list-item {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            background-color:#C0C0C0;
        }
        label{
            font-weight:bold;
        }
        .formulaire{
            margin-top: 15%;
        }
    </style>
</head>
<body>
    <div class="container formulaire">
        <div class="input-group flex-nowrap">
        <form class="form" action="./?action=RechercheFiche" method="POST">
                <label for="numero client" >Saisir un numéro client</label>
                <input type="number" name="numero_client" class="form-control" placeholder="Ex: 18">
                <button type="submit">Valider</button>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["numero_client"])) {
                    $numero_client = $_POST['numero_client'];

                    $Recherchefiche = getRecherchefiche($numero_client);
                    }
                
                if (!empty($Recherchefiche)) {
                    foreach ($Recherchefiche as $uneLigne) {
                      echo faire une liste deroulante et donc modifier requete pour avoir seulement le numero client dans la listes deroulante pour seulemetn apres avoir selectionner la fiche avoir toutes les informations de la liste de CE client
                        
                    }
                }
            }
                ?>
            </form>
        </div>

        <?php
        ?>
    </div>
</body>
</html>