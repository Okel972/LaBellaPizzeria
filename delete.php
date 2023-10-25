<?php

    session_start();

    include 'includes/dbh.inc.php';

    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        
        // Créez la requête DELETE
        $query = "DELETE FROM products WHERE id = ?";
        
        // Préparez la requête
        $stmt = mysqli_prepare($conn, $query);
    
        if ($stmt) {
            // Liez les paramètres et exécutez la requête
            mysqli_stmt_bind_param($stmt, "s", $product_id);
            mysqli_stmt_execute($stmt);
            
            if (mysqli_affected_rows($conn) > 0) {
                // La suppression a réussi
                echo "Le produit avec l'ID $product_id a été supprimé avec succès.";

                // Redirigez vers add-product.php après 2 secondes
                header("refresh:2;url=add-product.php");
            } else {
                // Aucun enregistrement trouvé avec l'ID spécifié
                echo "Aucun produit trouvé avec l'ID spécifié ou le produit a déjà été supprimé.";
            }
        } else {
            // Erreur de requête préparée
            echo "Erreur de requête préparée : " . mysqli_error($conn);
        }
    }    

?>