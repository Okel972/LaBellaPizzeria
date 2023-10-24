<?php
    session_start(); // Démarre ou reprend une session existante.

    // Inclure la configuration de la base de données
    include 'includes/dbh.inc.php';

    if (isset($_POST['update_product'])) {
        // Assurez-vous de vérifier si les valeurs POST sont définies avant de les utiliser.
        if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['rubric_name'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $rubric_name = $_POST['rubric_name'];

            // Effectuer la logique de modification
            $edit_sql = "UPDATE products SET name=?, price=?, category=? WHERE id=?";
            $edit_stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($edit_stmt, $edit_sql)) {
                mysqli_stmt_bind_param($edit_stmt, "ssdi", $product_name, $product_price, $rubric_name, $product_id);
                if (mysqli_stmt_execute($edit_stmt)) {
                    // La mise à jour a réussi, vous pouvez rediriger l'utilisateur
                    header("Location: edit-success.php");
                    exit();
                } else {
                    // Gestion de l'erreur de mise à jour
                    echo "Erreur lors de la mise à jour du produit.";
                }
            }
        } else {
            // Les données POST nécessaires pour la mise à jour ne sont pas toutes présentes.
            echo "Données manquantes pour la mise à jour.";
        }
    }
    
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $query = "SELECT name, price, category FROM products WHERE id = ?";
        
        // Préparez la requête
        $stmt = mysqli_prepare($conn, $query);
    
        if ($stmt) {
            // Liez les paramètres et exécutez la requête
            mysqli_stmt_bind_param($stmt, "i", $product_id);
            mysqli_stmt_execute($stmt);
    
            // Obtenir le résultat
            $result = mysqli_stmt_get_result($stmt);
    
            if ($row = mysqli_fetch_assoc($result)) {
                $product_name = $row['name'];
                $product_price = $row['price'];
                $rubric_name = $row['category'];
            } else {
                // Aucun enregistrement trouvé avec l'ID spécifié
                echo "Aucun produit trouvé avec l'ID spécifié.";
            }
        } else {
            // Erreur de requête préparée
            echo "Erreur de requête préparée : " . mysqli_error($conn);
        }
    }
    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

    <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style/add-product-style.css">
</head>

<body>

    <?php $page = 'update-product';include('header.php'); ?>

    <section class="product-form">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Update product</h3>

            <!-- Ajoutez des champs de formulaire pour product_id, product_name, product_price, et rubric_name -->
            <input type="text" name="product_id" value="<?php echo $product_id; ?>">

            <p>Product Name <span>*</span></p>
            <input type="text" name="product_name" value="<?php echo $product_name;?>" placeholder="Enter product name" required maxlength="50" class="box">

            <p>Product Price <span>*</span></p>
            <input type="number" name="price" value="<?php echo $product_price; ?>" placeholder="Enter product price" required min="0" max="9999999999" maxlength="10" class="box">

            <p>Rubric <span>*</span></p>
            <select name="rubric_name" required class="box">
                <option value="Pizza" <?php if ($rubric_name == 'Pizza') echo 'selected'; ?>>Pizza</option>
                <option value="Burger" <?php if ($rubric_name == 'Burger') echo 'selected'; ?>>Burger</option>
                <option value="Tacos" <?php if ($rubric_name == 'Tacos') echo 'selected'; ?>>Tacos</option>
                <option value="Wrap" <?php if ($rubric_name == 'Wrap') echo 'selected'; ?>>Wrap</option>
                <option value="Fries" <?php if ($rubric_name == 'Fries') echo 'selected'; ?>>Fries</option>
                <option value="Salad" <?php if ($rubric_name == 'Salad') echo 'selected'; ?>>Salad</option>
                <option value="Drink" <?php if ($rubric_name == 'Drink') echo 'selected'; ?>>Drink</option>
            </select>

            <!-- Assurez-vous d'ajouter le bouton de soumission pour la mise à jour du produit -->
            <input type="submit" class="btn" name="update_product" value="Update Product">
        </form>
    </section>

    <?php
    
    echo "Product ID: $product_id<br>";
    echo "Product Name: $product_name<br>";
    echo "Product Price: $product_price<br>";
    echo "Rubric Name: $rubric_name<br>";
    
    ?>

</body>

</html>