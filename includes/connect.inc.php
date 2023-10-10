<?php
   // Définition des informations de connexion à la base de données
   $db_name = 'mysql:host=localhost;dbname=laBella_pizzeria'; // Nom de l'hôte (localhost) et nom de la base de données (laBella_pizzeria)
   $db_user_name = 'root'; // Nom d'utilisateur de la base de données
   $db_user_pass = ''; // Mot de passe de l'utilisateur de la base de données (vide dans cet exemple)

   // Création d'une nouvelle instance PDO pour établir une connexion à la base de données
   $conn = new PDO($db_name, $db_user_name, $db_user_pass);
?>