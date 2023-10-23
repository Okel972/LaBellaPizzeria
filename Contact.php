<?php
    session_start(); // Démarre ou reprend une session existante.
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="refresh" content="3"> -->
        <title>Contact</title>
        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
    </head>
    
    <body>

        <?php $page = 'contact'; include('header.php'); ?>
        <!-- Inclusion d'un fichier 'header.php' dans cette page PHP. La variable $page est définie à 'contact' pour indiquer la page actuelle. -->

        <?php include('FormulaireDeContact.php'); ?>
        <!-- Inclusion d'un fichier 'FormulaireDeContact.php'. Cela suggère que le formulaire de contact est généré dans ce fichier PHP. -->

        <?php include('footer.php'); ?>
        <!-- Inclusion d'un fichier 'footer.php' pour afficher le pied de page de la page web. -->

    </body>

    <?php unset($_SESSION['inputs']); ?>

</html>