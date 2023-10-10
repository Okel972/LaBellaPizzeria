<?php
// Configuration des paramètres de la base de données
$serverName = "localhost";  // Nom du serveur de base de données (généralement "localhost" en développement local)
$dBUsername = "root";       // Nom d'utilisateur de la base de données
$dBPassword = "";           // Mot de passe de la base de données (vide dans cet exemple)
$dBName = "laBella_pizzeria"; // Nom de la base de données que vous souhaitez utiliser

// Établissement de la connexion à la base de données en utilisant mysqli_connect
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

// Vérification si la connexion à la base de données a réussi
if (!$conn) {
    // Si la connexion a échoué, affiche un message d'erreur et arrête le script en utilisant die()
    die("Connection failed: " . mysqli_connect_error());
}