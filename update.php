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

// Valider l'action (assurez-vous que c'est soit 'edit' soit 'delete')
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'edit' || $action === 'delete') {
        if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
            $product_id = $_POST['product_id'];

            // Échapper les données du formulaire (pour éviter les injections SQL)
            $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
            $product_price = floatval($_POST['price']); // Convertir en nombre à virgule flottante
            $rubric_name = mysqli_real_escape_string($conn, $_POST['rubric_name']);
        }

        if ($action === 'delete') {
            // Effectuer la logique de suppression
            $delete_sql = "DELETE FROM products WHERE id=?";
            $delete_stmt = mysqli_stmt_init($conn);
        
            if (mysqli_stmt_prepare($delete_stmt, $delete_sql)) {
                mysqli_stmt_bind_param($delete_stmt, "i", $product_id);
                if (mysqli_stmt_execute($delete_stmt)) {
                    // Le produit a été supprimé avec succès
                    header("Location: delete-success.php");
                    exit();
                } else {
                    // Gestion de l'erreur de suppression
                    echo "Erreur lors de la suppression du produit.";
                }
            }
        } else {
            // Product ID non valide
            echo "ID de produit non valide.";
        }
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
    <link rel="stylesheet" href="style/add-product-style.css">
</head>

<body>

    <?php
    $page = 'update-product';
    include('header.php');
    
    // Récupérez les valeurs product_id, product_name, product_price, et rubric_name depuis le code PHP.
    // Assurez-vous que ces valeurs sont définies avant de les utiliser.
    $product_id = isset($product_id) ? $product_id : '';
    $product_name = isset($product_name) ? $product_name : '';
    $product_price = isset($product_price) ? $product_price : '';
    $rubric_name = isset($rubric_name) ? $rubric_name : '';
    ?>

    <section class="product-form">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Product Info</h3>

            <!-- Ajoutez des champs de formulaire pour product_id, product_name, product_price, et rubric_name -->
            <input type="text" name="product_id" value="<?php echo $product_id; ?>">

            <p>Product Name <span>*</span></p>
            <input type="text" name="product_name" value="<?php echo $product_name; ?>" placeholder="Enter product name" required maxlength="50" class="box">

            <p>Product Price <span>*</span></p>
            <input type="number" name="price" value="<?php echo $product_price; ?>" placeholder="Enter product price" required min="0" max="9999999999" maxlength="10" class="box">

            <p>Rubric <span>*</span></p>
            <select name="rubric_name" required class="box">
                <option value="pizza" <?php if ($rubric_name == 'pizza') echo 'selected'; ?>>Pizza</option>
                <option value="burger" <?php if ($rubric_name == 'burger') echo 'selected'; ?>>Burger</option>
                <option value="tacos" <?php if ($rubric_name == 'tacos') echo 'selected'; ?>>Tacos</option>
                <option value="wrap" <?php if ($rubric_name == 'wrap') echo 'selected'; ?>>Wrap</option>
                <option value="fries" <?php if ($rubric_name == 'fries') echo 'selected'; ?>>Fries</option>
                <option value="salad" <?php if ($rubric_name == 'salad') echo 'selected'; ?>>Salad</option>
                <option value="drink" <?php if ($rubric_name == 'drink') echo 'selected'; ?>>Drink</option>
            </select>

            <!-- Assurez-vous d'ajouter le bouton de soumission pour la mise à jour du produit -->
            <input type="submit" class="btn" name="update_product" value="Update Product">
        </form>
    </section>

</body>

</html>