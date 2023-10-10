<?php

session_start(); // Démarre une session PHP existante ou en crée une nouvelle

session_unset(); // Efface toutes les données de la session en cours

session_destroy(); // Détruit complètement la session

// Redirige l'utilisateur vers la page d'accueil (index.php)
header("location: ../index.php");
exit();