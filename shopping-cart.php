<?php

    session_start(); // Démarrage de la session PHP

    // Inclusion des fichiers nécessaires pour la connexion à la base de données et les fonctions
    include_once 'includes/connect.inc.php';
    include_once 'includes/functions.inc.php';

    include_once 'includes/cookie.inc.php';

    // Vérification si le formulaire pour mettre à jour la quantité d'un article dans le panier a été soumis
    if(isset($_POST['update_cart'])){

        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    
        // Préparation et exécution d'une requête SQL pour mettre à jour la quantité dans la table 'cart'
        $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);
    
        $success_msg[] = 'Cart quantity updated!';
    
    }
    
    // Vérification si le formulaire pour supprimer un article du panier a été soumis
    if(isset($_POST['delete_item'])){
    
        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
        
        // Vérification si l'article existe dans la table 'cart'
        $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
        $verify_delete_item->execute([$cart_id]);
    
        if($verify_delete_item->rowCount() > 0){
            // Si l'article existe, préparation et exécution d'une requête SQL pour le supprimer
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_cart_id->execute([$cart_id]);
        $success_msg[] = 'Cart item deleted!';
        }else{
        $warning_msg[] = 'Cart item already deleted!';
        } 
    
    }
    
    // Vérification si le formulaire pour vider complètement le panier a été soumis
    if(isset($_POST['empty_cart'])){
        // Vérification si le panier de l'utilisateur contient des articles
        $verify_empty_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $verify_empty_cart->execute([$user_id]);
    
        if($verify_empty_cart->rowCount() > 0){
            // Si le panier n'est pas vide, préparation et exécution d'une requête SQL pour le vider
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_id->execute([$user_id]);
        $success_msg[] = 'Cart emptied!';
        }else{
        $warning_msg[] = 'Cart already emptied!';
        } 
    
    }
 
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart</title>

        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/shopping-cart-style.css">
    </head>

    <body>
        
        <?php $page = ''; include('header.php'); ?>

        <section class="products">
            <!-- Titre de la page du panier -->
            <h1 class="heading">shopping cart</h1>

            <!-- Conteneur pour les produits du panier -->
            <div class="box-container">

                <?php
                // Initialisation d'une variable $grand_total pour stocker le coût total du panier
                $grand_total = 0;

                // Vérification de l'existence d'un utilisateur connecté
                if(isset($_COOKIE['user_id'])) {
                    // Récupération des produits dans le panier de l'utilisateur
                    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);

                    // Si le panier est vide, afficher un message
                    if($select_cart->rowCount() == 0) {
                        echo '<p class="empty">your cart is empty!</p>';
                    }
                    // Sinon, s'il y a des produits dans le panier, les afficher
                    else if($select_cart->rowCount() > 0){
                        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){

                            // Récupération des informations du produit à partir de la base de données
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");

                            $select_products->execute([$fetch_cart['product_id']]);

                            if($select_products->rowCount() > 0){
                                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);

                            ?>

                            <!-- Formulaire pour gérer les produits du panier -->
                            <form action="" method="POST" class="box">
            
                                <!-- Champ caché pour stocker l'ID du produit dans le panier -->
                                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            
                                <!-- Affichage de l'image du produit depuis un répertoire 'uploaded_files' -->
                                <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
            
                                <!-- Affichage du nom du produit -->
                                <h3 class="name"><?= $fetch_product['name']; ?></h3>
            
                                <div class="flex">
            
                                    <!-- Affichage du prix du produit -->
                                    <p class="price"><i class="fas fa-indian-rupee-sign"></i> <?= $fetch_cart['price']; ?></p>
            
                                    <!-- Champ pour la quantité du produit -->
                                    <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">
            
                                    <!-- Bouton pour mettre à jour la quantité du produit -->
                                    <button type="submit" name="update_cart" class="fas fa-edit"></button>
            
                                </div>
            
                                <!-- Affichage du sous-total pour chaque produit -->
                                <p class="sub-total">sub total : <span><i class="fas fa-indian-rupee-sign"></i> <?= $sub_total = ($fetch_cart['qty'] * $fetch_cart['price']); ?></span></p>
            
                                <!-- Bouton pour supprimer le produit du panier -->
                                <input type="submit" value="delete" name="delete_item" class="delete-btn" onclick="return confirm('delete this item?');">
            
                            </form>
            
                            <?php

                            // Calcul du coût total en ajoutant le sous-total de chaque produit
                            $grand_total += $sub_total;
                            }
                            else{
                                echo '<p class="empty">product was not found!</p>';
                            }
                        }
                    }
                }
                else{
                    $select_cart = 0;
                    // Si l'utilisateur n'est pas connecté ou s'il n'y a pas de panier, afficher un message
                    echo '<p class="empty">your cart is empty!</p>';
                }
                ?>

            </div>

            <!-- Affichage du coût total du panier -->
            <?php if($grand_total != 0){ ?>

            <div class="cart-total">

                <p>grand total : <span><i class="fas fa-indian-rupee-sign"></i><?= $grand_total; ?></span></p>

                <!-- Formulaire pour vider le panier -->
                <form action="" method="POST">
                    <input type="submit" value="empty cart" name="empty_cart" class="delete-btn" onclick="return confirm('empty your cart?');">
                </form>
                
                <!-- Lien pour passer à la page de paiement (checkout) -->
                <a href="checkout.php" class="btn">proceed to checkout</a>

            </div>

            <?php } ?>

        </section>

        <!-- Inclusion de la bibliothèque JavaScript sweetAlert pour afficher des messages d'alerte -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- <script src="js/script.js"></script> -->

        <?php include 'includes/alert.inc.php'; ?>

    </body>

</html>
