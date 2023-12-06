<!DOCTYPE html>
<html lang="en">
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
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
            background-color:#696969;
            color: white;
            padding: 10px 174px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color:grey;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="input-group flex-nowrap">
            <form method="POST" action="">
                <input type="text" name="numero_client" class="form-control" placeholder="Saisir un numéro client" aria-label="Saisir un numéro client" aria-describedby="addon-wrapping">
                <button type="submit">Valider</button>
            </form>
        </div>

        <?php
        ?>
    </div>
</body>
</html>
