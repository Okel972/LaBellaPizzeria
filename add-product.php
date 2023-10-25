<?php

    session_start(); // Démarre ou reprend une session existante.

    // Inclure la configuration de la base de données ici
    include 'includes/dbh.inc.php';

    // Vérifier si un produit a été soumis pour édition ou suppression
    if(isset($_POST['edit_product_id'])) {
    $edit_product_id = $_POST['edit_product_id'];
    // Rediriger vers la page d'édition avec l'ID du produit
    header("Location: update.php?id=" . $edit_product_id);
    exit();
    }

    if(isset($_POST['delete_product_id'])) {
    $delete_product_id = $_POST['delete_product_id'];
    // Rediriger vers la page de suppression avec l'ID du produit
    header("Location: delete.php?id=" . $delete_product_id);
    exit();
    }

    // Lire les données de la base de données
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

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

        <h1>Editer/Supprimer</h1>

        <div class="table-container">

            <form method="post">
            <!-- Formulaire pour la gestion des produits -->

                <table class="table">
                <!-- Tableau avec la classe "table" pour appliquer des styles spécifiques -->

                    <tr class="table-header">
                    <!-- Ligne d'en-tête du tableau -->

                        <th>ID</th>
                        <!-- Cellule d'en-tête "ID" -->
                        <th>Nom</th>
                        <!-- Cellule d'en-tête "Nom" -->
                        <th>Prix</th>
                        <!-- Cellule d'en-tête "Prix" -->
                        <th>Image</th>
                        <!-- Cellule d'en-tête "Image" -->
                        <th>Catégorie</th>
                        <!-- Cellule d'en-tête "Catégorie" -->
                        <th>Modifier</th>
                        <!-- Cellule d'en-tête "Modifier" -->
                        <th>Supprimer</th>
                        <!-- Cellule d'en-tête "Supprimer" -->

                    </tr>
                    <!-- Fin de la ligne d'en-tête -->

                    <?php

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) { 
                                // Début d'une boucle pour afficher les données de la base de données
                                ?>

                                <tr>
                                <!-- Ouvre une nouvelle ligne de tableau -->

                                    <td class='table-cell'><?= $row['id'] ?></td>
                                    <!-- Cellule avec l'ID -->
                                    <td class='table-cell'><?= $row['name'] ?></td>
                                    <!-- Cellule avec le nom -->
                                    <td class='table-cell'><?= $row['price'] ?></td>
                                    <!-- Cellule avec le prix -->
                                    <td class='table-cell'><img src='uploaded_files/<?= $row['image'] ?>' width='50' height='50' alt=''></td>
                                    <!-- Cellule avec l'image (un lien vers le dossier "uploaded_files") -->
                                    <td class='table-cell'><?= $row['category'] ?></td>
                                    <!-- Cellule avec la catégorie -->

                                    <td class='table-cell'>

                                        <button type="submit" name="edit_product_id" class='edit-btn' value="<?= $row['id'] ?>">Modifier</button>
                                        <!-- Cellule avec un lien pour la mise à jour -->

                                    </td>

                                    <td class='table-cell'>

                                        <button type="submit" name="delete_product_id" class='delete-btn' value="<?= $row['id'] ?>">Supprimer</button>
                                        <!-- Cellule avec un lien pour la suppression -->

                                    </td>

                                </tr>
                                <!-- Fin de la ligne de données -->

                                <?php 
                                // Fin de la boucle pour afficher les données de la base de données
                            }
                        } else {
                            // Si aucun produit n'a été trouvé, affichez un message d'erreur
                            echo '<p class="empty">Aucun produit trouvé !</p>';
                        }
                        
                    ?>

                </table>

            </form>
            <!-- Fin du tableau -->

        </div>
        <!-- Fin de la div "table-container" -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- Inclusion d'une bibliothèque JavaScript pour afficher des messages d'alerte personnalisés (sweetAlert). -->

        <script type="text/javascript" src="script/script-btnDelete.js"></script>

        <?php include 'includes/alert.inc.php'; ?>
        <!-- Inclusion d'un fichier 'alert.inc.php' qui gère les alertes dans la page. -->

        <?php include('footer.php'); ?>

    </body>
    
</html>