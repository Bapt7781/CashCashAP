<?php

// Fonction pour établir une connexion PDO à la base de données
function connexionPDO() {
    // Paramètres de connexion à la base de données
    $login = "root"; // Nom d'utilisateur MySQL
    $mdp = ""; // Mot de passe MySQL
    $bd = "cashcash"; // Nom de la base de données
    $serveur = "localhost"; // Nom du serveur MySQL

    try {
        // Création d'une nouvelle instance de PDO pour la connexion à la base de données
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        // Définition du mode d'erreur de PDO sur ERRMODE_EXCEPTION
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Retourne l'objet de connexion PDO
    } catch (PDOException $e) {
        // En cas d'erreur de connexion, inclut un fichier de vue d'erreur de connexion
        include "$racine/vue/VueErreurCo.php";
    }
}

// Programme principal de test
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Entête de test pour affichage en texte brut
    header('Content-Type:text/plain');

    // Test de la fonction de connexionPDO
    echo "connexionPDO() : \n";
    print_r(connexionPDO());
}
?>
