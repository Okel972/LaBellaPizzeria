<?php

// Initialisation d'un tableau vide pour stocker les messages d'avertissement
$warning_msg = [];
// Définition des adresses e-mail pour chaque service
$emails = ['contact@infozone.dev', 'commandes@infozone.dev', 'information@infozone.dev'];

// Vérification des données du formulaire
if(!isset($_POST["nameContact"]) || $_POST["nameContact"] == "") {
    $warning_msg["nameContact"] = "Invalid-name ";
}

if(!isset($_POST["emailContact"]) || $_POST["emailContact"] == "" || !filter_var($_POST['emailContact'], FILTER_VALIDATE_EMAIL)) {
    $warning_msg["emailContact"] = " Invalid-email ";
}

if(!isset($_POST["messageContact"]) || $_POST["messageContact"] == "") {
    $warning_msg["messageContact"] = " Invalid-message ";
}

if(!isset($_POST["service"]) || !isset($emails[$_POST["service"]])) {
    $warning_msg["service"] = " Invalid-service";
}

// Démarrage d'une session PHP
session_start();

// Si des erreurs sont détectées dans le formulaire
if(!empty($warning_msg)){
    // Stockage des messages d'erreur dans la session
    $_SESSION['errors'] = $warning_msg;
    // Stockage des données du formulaire dans la session
    $_SESSION['inputs'] = $_POST;
    // Redirection vers la page de contact
    header('location: ../Contact.php');
} 
else {
    // Si aucune erreur n'est détectée, le formulaire est valide
    // Message de succès dans la session
    $_SESSION['success'] = "Votre email a bien été envoyé";
    // Création des en-têtes pour l'e-mail (expéditeur)
    $headers = 'FROM: ' . $_POST['emailContact'];
    // Envoi de l'e-mail à l'adresse appropriée en fonction du service sélectionné
    mail($emails[$_POST['service']], 'Formulaire de contact de ' . $_POST['nameContact'], $_POST['messageContact'], $headers);
    // Redirection vers la page de contact
    header('Location: ../Contact.php');
}