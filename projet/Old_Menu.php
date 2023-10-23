<?php

    include_once 'includes/connect.inc.php';
    include_once 'includes/functions.inc.php';

    include_once 'includes/cookie.inc.php';

    // Vérification si le formulaire d'ajout au panier a été soumis
    if (isset($_POST['add_to_cart'])) {

        // Génération d'un identifiant unique pour l'article ajouté au panier
        $id = create_unique_id();

        // Récupération de l'ID du produit et sécurité
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Récupération de la quantité et sécurité
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Vérification si le produit est déjà dans le panier de l'utilisateur
        $verify_cart = $conn -> prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");   
        $verify_cart -> execute([$user_id, $product_id]);

        // Vérification du nombre maximum d'articles autorisés dans le panier
        $max_cart_items = $conn -> prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $max_cart_items -> execute([$user_id]);

        // Si le produit est déjà dans le panier, afficher un avertissement
        if ($verify_cart -> rowCount() > 0){
            $warning_msg[] = 'Already added to cart!';
        }
        // Sinon, si le panier est plein (10 articles maximum), afficher un avertissement
        elseif ($max_cart_items -> rowCount() == 10){
            $warning_msg[] = 'Cart is full!';
        }
        // Sinon, ajouter le produit au panier
        else {
            // Récupération du prix du produit à partir de la base de données
            $select_price = $conn -> prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_price -> execute([$product_id]);
            $fetch_price = $select_price -> fetch(PDO::FETCH_ASSOC);

            // Insérer le produit dans la table 'cart' avec l'ID unique généré
            $insert_cart = $conn -> prepare("INSERT INTO `cart`(id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
            $insert_cart -> execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
            $success_msg[] = 'Added to cart!';
        }

    }

    // Préparation de la requête SQL pour récupérer les produits
    $select_products = $conn->prepare("SELECT * FROM `products`");

    // Exécution de la requête SQL pour récupérer les produits
    $select_products->execute();

?>

<?php

    include_once 'includes/dbh.inc.php';

    // Si la catégorie est définie dans les paramètres GET
    if (isset($_GET['category'])) {
        $category = $_GET['category'];

        // Utilisez la catégorie dans la requête SQL
        $sql = "SELECT * FROM products WHERE category = '$category'";
    } else {
        // Si aucune catégorie n'est spécifiée, récupère tous les produits
        $sql = "SELECT * FROM products";
    }

    // Exécutez la requête SQL et affichez les produits
    $resultat = mysqli_query($conn, $sql);

    // Parcourez les résultats pour afficher les produits
    while ($row = mysqli_fetch_assoc($resultat)) {
        echo '<div>' . $row['name'] . '</div>';
        // Ajoutez d'autres informations sur les produits
    }

    // Fermez la connexion à la base de données
    mysqli_close($conn);
?>


<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="refresh" content="3"> -->
        <title>Menu</title>
        <link rel="stylesheet" href="style/menu-style.css">
    </head>

    <body>

        <header>
            <!-- Affichage du titre de la catégorie dans l'en-tête de la page -->
            <div class="title"><?= $categoryTitle ?></div>
        </header>




        <!-- A faire apparaitre que si c'est pizza -->
        <!-- <div class="topbar-container">

            <div class="topbar">
                <a href="#" class="base-1">Base tomate</a>
                <a href="#" class="base-2">Base crème fraîche</a>
                <a href="#" class="base-3">Base chocolat</a>
            </div>

        </div> -->




        <!-- Section de menu -->
        <section class="all-menu">

            
            <?php                
                // Vérification si des produits sont disponibles
                if($select_products->rowCount() > 0){
                    while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            
            <!-- Formulaire pour ajouter un produit au panier -->
            <form action="" method="POST">

                <article class="presentation-produit">
                    
                    <!-- Affichage de l'image du produit depuis un répertoire 'uploaded_files' -->
                    <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image-plat1"></img>

                    <!-- Champ caché pour stocker l'ID du produit -->
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                    <!-- Contenu du produit (titre, prix) -->
                    <div class="plat">

                        <div class="plat-title"><?= $fetch_product['name'] ?></div>

                        <!-- A intégrer -->
                        <!-- <div class="plat-ingredient">Base tomate, fromage, olives vertes, olives noires…</div> -->

                        <div class="plat-price"><?= $fetch_product['price'] ?></div>

                        <!-- Champ pour la quantité du produit -->
                        <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2">

                    </div>
                    
                    <!-- Bouton pour ajouter le produit au panier -->
                    <input type="submit" name="add_to_cart" value="add to cart" class="btn">

                </article>

            </form>


            <?php
                    }
                }else {
                    echo '<p class="empty">no products found!</p>';
                }
            ?>

        </section>

        <!-- Inclusion de la bibliothèque JavaScript sweetAlert pour afficher des messages d'alerte -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- Inclusion d'un fichier 'alert.inc.php' pour gérer les alertes -->
        <?php include 'includes/alert.inc.php'; ?>
        
    </body>

</html>