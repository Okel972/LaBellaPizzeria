<head>
    <link rel="stylesheet" href="style/header-style.css">
</head>

<body>

    <!-- En-tête de la page (barre supérieure) -->
    <header class="topbar">

        <!-- Conteneur du logo -->
        <div class="logo-container">
            <!-- Lien du logo pointant vers la page d'accueil -->
            <a href="index.php" class="topbar-logo1">La Bella</a>
        </div>

        <!-- Menu de navigation en haut de la page -->
        <div class="topbar-menu">

            <!-- Barre de navigation principale -->
            <nav class="topbar-nav">

                <!-- Liens de navigation avec des classes 'active' pour mettre en évidence la page actuelle -->
                <a href="index.php" class="<?php if($page =='home') {echo 'active';}?>">Accueil</a>
                <a href="Carte.php" class="<?php if($page =='menu') {echo 'active';}?>">Carte</a>
                <a href="Contact.php" class="<?php if($page =='contact') {echo 'active';}?>">Contact</a>

                <!-- Affiche le lien "Admin" si un utilisateur est connecté -->
                <?php
                
                    if (isset($_SESSION["useruid"])) {
                        echo "<a href='add-product.php' class='" . ($page == 'add-product' ? 'active' : '') . "'>Admin</a>";
                    }
                
                ?>

            </nav>

            <!-- Bouton pour afficher/masquer la navigation sur mobile -->
            <button type="button" aria-label="toggle curtain navigation" class="nav-toggler">
                <span class="line l1"></span>
                <span class="line l2"></span>
                <span class="line l3"></span>
            </button>

            <!-- Section vide pour la mise en page -->
            <section class="home"></section>
        
        </div>
        
        <!-- Dernière section de la barre supérieure -->
        <div class="topbar-last-section">

            <!-- Conteneur pour le numéro de téléphone et les icônes -->
            <div class="container-numero">

                <!-- Icône de téléphone -->
                <img href="#" class="img-numero" src="img/phone1.svg" />

                <!-- Numéro de téléphone -->
                <span href="#" class="numero">06 01 02 03 04</span>

                <?php
                    // Inclusion d'un fichier PHP pour ajouter un produit
                    include('includes/add-product.inc.php');
                
                    // Vérification de la présence d'un cookie utilisateur pour le panier
                    if(isset($_COOKIE['user_id'])){
                        // Compte le nombre d'articles dans le panier de l'utilisateur
                        $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $count_cart_items->execute([$user_id]);
                        $total_cart_items = $count_cart_items->rowCount();
                    } 
                    else {
                        $total_cart_items = 0;
                    }
                ?>

                <!-- Icône de panier avec le nombre d'articles dans le panier -->
                <a href="shopping-cart.php" class="cart-icon"><img src="img/shopping-cart-line.png"><span><?= $total_cart_items; ?></span></a>

                <!-- Icône de recherche -->
                <a href="#" title="search"><img src="img/search.svg" title="search" class="img-search"></a>
                
            </div>

        </div>

    </header>

    <!-- Inclusion d'un fichier JavaScript externe pour la fonctionnalité de l'en-tête en mode mobile -->
    <script type="text/javascript" src="script/script-header.js"></script>

</body>