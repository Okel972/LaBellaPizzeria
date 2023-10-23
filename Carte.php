<?php
    session_start(); // Démarre ou reprend une session existante.
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="refresh" content="3"> -->
        <title>LaCarte</title>
        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/carte-style.css">
    </head>

    <body>

        <?php $page = 'menu'; include('header.php'); ?>

        <!-- Section de recherche -->
        <div class="search-bar-container">

            <div class="search-bar">
                <hr>
                <!-- Barre de recherche -->
                <input type="search" placeholder="Search" class="search-bar-input">
            </div>        
            
        </div>

        <!-- Filtres de catégorie de menu -->
        <div class="menu-filter">

            <!-- Liens pour filtrer par catégorie de produits -->
            <a 
            href="javascript:void(0);" onclick="loadCategory('pizza')" class="text-icon">
            <img src="img/pizza.svg" alt="" class="icon-text">Pizza</a>

            <a 
            href="javascript:void(0);" onclick="loadCategory('burger')" class="text-icon">
            <img src="img/burger.svg" alt="" class="icon-text">Burgers</a>

            <a 
            href="javascript:void(0);" onclick="loadCategory('tacos')" class="text-icon">
            <img src="img/tacos.svg" alt="" class="icon-text">Tacos</a>

            <a 
            href="javascript:void(0);" onclick="loadCategory('wrap')" class="text-icon">
            <img src="img/wrap.svg" alt="" class="icon-text">Wraps</a>

            <a 
            href="javascript:void(0);" onclick="loadCategory('fries')" class="text-icon">
            <img src="img/fries.svg" alt="" class="icon-text">Fries</a>

            <a 
            href="javascript:void(0);" onclick="loadCategory('salad')" class="text-icon">
            <img src="img/salads.svg" alt="" class="icon-text">Salads</a>

            <a 
            href="javascript:void(0);" onclick="loadCategory('drink')" class="text-icon">
            <img src="img/drinks.svg" alt="" class="icon-text">Drinks</a>

        </div>

        <div class="produit">
            <!-- Inclusion d'un iframe pour afficher le contenu du menu (Menu.php) -->
            <!-- <iframe src="Menu.php" class="carte"></iframe> -->
            <iframe id="menu-iframe" src="Menu.php" class="carte"></iframe>
        </div>

        <?php include('footer.php'); ?>

        <script src="script/script-menu.js"></script>

    </body>

</html>