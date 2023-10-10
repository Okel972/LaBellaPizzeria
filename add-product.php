<?php
    session_start(); // Démarre ou reprend une session existante.
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Product</title>

        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="style/add-product-style.css">
    </head>
    
    <body>
    
        <?php $page = 'add-product'; include('header.php'); ?>

        <section class="product-form">

            <form action="" method="POST" enctype="multipart/form-data">

                <h3>product info</h3>

                <p>Product name <span>*</span></p>
                <input type="text" name="product-name" placeholder="Enter product name" required maxlength="50" class="box">
                <!-- Champ de saisie du nom du produit -->

                <p>Product price <span>*</span></p>
                <input type="number" name="price" placeholder="Enter product price" required min="0" max="9999999999" maxlength="10" class="box">
                <!-- Champ de saisie du prix du produit (nombre) -->

                <p>Rubric <span>*</span></p>
                <select name="rubric-name" required class="box">
                <!-- Sélection de la catégorie du produit -->
                    <option value="pizza">Pizza</option>
                    <option value="burger">Burger</option>
                    <option value="tacos">Tacos</option>
                    <option value="wrap">Wrap</option>
                    <option value="fries">Fries</option>
                    <option value="salad">Salad</option>
                    <option value="drink">Drink</option>
                </select>

                <p>Product image <span>*</span></p>
                <input type="file" name="image" required accept="image/*" class="box">
                <!-- Champ pour téléverser une image du produit -->
                
                <input type="submit" class="btn" name="add" value="add product">
                <!-- Bouton pour soumettre le formulaire -->
                
            </form>

        </section>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- Inclusion d'une bibliothèque JavaScript pour afficher des messages d'alerte personnalisés (sweetAlert). -->

        <!-- <script src="js/script.js"></script> -->

        <?php include 'includes/alert.inc.php'; ?>
        <!-- Inclusion d'un fichier 'alert.inc.php' qui gère les alertes dans la page. -->

        <?php include('footer.php'); ?>

    </body>
    
</html>