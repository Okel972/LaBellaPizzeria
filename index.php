<?php
    session_start(); // Démarre ou reprend une session existante.
?>

<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="refresh" content="3"> -->
        <title>La Bella</title>
        
        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
        <link rel="stylesheet" href="style/accueil-style.css">
    </head>


    <body>

        <?php $page = 'home'; include('header.php'); ?>

        <?php include('carousel.php'); ?>

        <!-- Section des promotions -->
        <section class="promotions">

            <!-- Article de promotion à gauche -->
            <article class="promo_L">
                <span class="promo-left-title">Promotion</span>
                <span class="promo-left-day">Les Mardis</span>
                <span class="promo-left-comment">Ne manquez pas notre promotion<br>pizza à moitié prix !</span>
                <span class="promo-left-price">7.00€</span>
                <a class="promo-left-order">commander</a>
                <div class="promo-left-image"></div>
            </article>

            <!-- Article de promotion à droite -->
            <article class="promo_R">
                <span class="promo-right-title">Promotion</span>
                <span class="promo-right-day">Les Vendredis</span>
                <span class="promo-right-comment1">3 pizzas Maxi achetées</span>
                <span class="promo-right-price">La 3ème à 3.00€*</span>
                <span class="promo-right-comment2">*la moins chère des trois</span>
                <a class="promo-right-order">commander</a>
                <div class="promo-right-image"></div>
            </article>

        </section>

        <!-- Section des produits ajoutés (pizza, burger, drink, etc) -->
        <section class="produit">
            <iframe src="Menu.php" class="carte"></iframe>
        </section>

        <!-- Section "À propos de nous" -->
        <section class="about-us">

            <!-- Article pour la carte de fidélité -->
            <article class="fidelite">
                <img src="img/Loyalty1.png" alt="#" class="image-fidelite">
            </article>

            <!-- Article pour la carte Google Maps (adresse du resto) -->
            <article class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d42005.89425910024!2d2.2959521546794153!3d48.8511851894762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671efd6799067%3A0xb5c16f7b15baafd7!2sLe%20Jardin%20des%20P%C3%A2tes!5e0!3m2!1sfr!2sfr!4v1685437534279!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="image-maps"></iframe>
            </article>
            
            <!-- Article pour accéder au formulaire de contact -->
            <article class="contact">
                <iframe src="FormulaireDeContact.php" class="formulaire-contact"></iframe>
            </article>

            <!-- Vérification des paramètres GET pour afficher un message pour la connexion et la déconnexion -->
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "connected") {
                        $success_msg[] = 'You are connected';
                    }
                    else if ($_GET["error"] == "disconnected") {
                        $success_msg[] = 'You are disconnected';
                    }
                }
            ?>

        </section>

        <!-- Inclusion de la bibliothèque JavaScript sweetAlert pour afficher des messages d'alerte -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- Inclusion d'un fichier 'alert.inc.php' pour gérer les alertes -->
        <?php include 'includes/alert.inc.php'; ?>

        <?php include('footer.php'); ?>

    </body>

</html>