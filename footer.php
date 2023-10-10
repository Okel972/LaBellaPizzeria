<head>
    <link rel="stylesheet" href="style/footer-style.css">
</head>

<body>

    <!-- Section du pied de page -->
    <footer class="footer">

        <!-- Barre de médias sociaux -->
        <div class="social-bar">

            <!-- Liens vers les réseaux sociaux avec des icônes -->
            <nav class="social">

                <a href="https://www.snapchat.com/fr-FR" target="_blank">
                    <img src="img/snapchat.svg" alt="#" class="social-icone">
                </a>
                <a href="https://twitter.com/" target="_blank">
                    <img src="img/twitter.svg" alt="#" class="social-icone">
                </a>
                <a href="https://www.youtube.com/" target="_blank">
                    <img src="img/youtube.svg" alt="#" class="social-icone">
                </a>
                <a href="https://www.facebook.com/?wtsid=rdr_0XByzIW7A6TqBWcAP" target="_blank">
                    <img src="img/facebook.svg" alt="#" class="social-icone">
                </a>
                <a href="https://www.instagram.com/" target="_blank">
                    <img src="img/instagram.png" alt="#" class="social-icone">
                </a>
                <a href="https://www.tiktok.com/foryou" target="_blank">
                    <img src="img/tiktok.svg" alt="#" class="social-icone">
                </a>

            </nav>

        </div>

        <!-- Barre d'informations -->
        <div class="info-bar">

            <!-- Première colonne d'informations -->
            <article class="premiere-colonne">

                <!-- Titre de la première colonne -->
                <span class="premiere-colonne-title">Liens utiles</span>

                <!-- Liens vers des pages utiles -->
                    <a href="liensUtiles/mentionsLegales.html" target="_blank" class="first-lign">Mentions légales</a>
                    <a href="liensUtiles/politiqueDeCookies.html" target="_blank" class="first-lign">Politique de cookies</a>
                    <a href="liensUtiles/politiqueDeDonnees.html" target="_blank" class="first-lign">Politique de données</a>
                    <a href="liensUtiles/conditionsGenerales.html" target="_blank" class="first-lign">Conditions Générales</a>
                    <a href="liensUtiles/copyright.html" target="_blank" class="first-lign">Copyright</a>

                <!-- Condition PHP : affiche un bouton de déconnexion (Logout) ou un bouton de connexion (Login) en fonction de l'état de la session -->
                    <?php
                        if (isset($_SESSION["useruid"])) {
                            echo "<button class='btnLogout'><a href='logout.php'>Logout</a></button>";
                        }
                        else {
                            echo "<button class='btnLogin-popup'><a href='login.php'>Login</a></button>";
                        }
                    ?>
            </article>

            <!-- Deuxième colonne d'informations -->
            <article class="deuxieme-colonne">

                <!-- Titre de la deuxième colonne -->
                <span class="deuxieme-colonne-title">Horaires d'ouverture</span>
                
                <!-- Informations sur les horaires d'ouverture -->
                    <p href="#" class="week1">Du dimanche au jeudi</p>
                    <p href="#" class="hours1">de 11h à 14h et de 18h à 23h</p>
                    <p href="#" class="week2">et du vendredi au samedi</p>
                    <p href="#" class="hours2">de 18h à 00h</p>

            </article>

        </div>

    </footer>
    
</body>