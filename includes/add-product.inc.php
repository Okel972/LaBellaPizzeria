<?php

include_once 'includes/connect.inc.php';
include_once 'includes/functions.inc.php';

include_once 'includes/cookie.inc.php';

// Vérification si le formulaire a été soumis
if(isset($_POST['add'])){

   // Génération d'un identifiant unique pour le produit
   $id = create_unique_id();

   // Récupération du nom du produit depuis le formulaire
   $productName = $_POST['product-name'];
   $productName = filter_var($productName, FILTER_SANITIZE_SPECIAL_CHARS);

   // Récupération du prix du produit depuis le formulaire
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_VALIDATE_FLOAT);

   // Récupération de la catégorie du produit depuis le formulaire
   $category = $_POST['rubric-name'];
   $category = filter_var($category, FILTER_SANITIZE_SPECIAL_CHARS);

   // Récupération du nom de l'image téléchargée depuis le formulaire
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);

   // Récupération de l'extension de l'image
   $ext = pathinfo($image, PATHINFO_EXTENSION);

   // Renommage de l'image avec un identifiant unique pour éviter les doublons
   $rename = create_unique_id().'.'.$ext;

   // Récupération du chemin temporaire de l'image téléchargée
   $image_tmp_name = $_FILES['image']['tmp_name'];
   // Récupération de la taille de l'image téléchargée
   $image_size = $_FILES['image']['size'];
   // Définition du dossier de destination pour l'image
   $image_folder = 'uploaded_files/'.$rename;

   // Vérification si la catégorie est valide (doit appartenir à une liste prédéfinie)
   if (!in_array($category, ["pizza", "burger", "tacos", "wrap", "fries", "salad", "drink"])) {
      $warning_msg[] = "Le nom de la table n'est pas valide" ;
   }
   // Vérification de la taille de l'image (2 Mo maximum)
   elseif($image_size > 2000000){
      $warning_msg[] = 'Image size is too large!';
   }
   // Déplacement de l'image téléchargée vers son emplacement final
   elseif (!move_uploaded_file($image_tmp_name, $image_folder)) {
      $warning_msg[] = 'Impossible de déplacer l\'image vers sa destination.';
   }
   else{
      try {
         // Préparation et exécution de la requête SQL pour insérer le produit dans la base de données
         $add_product = "INSERT INTO `products` (id, name, price, image, category) VALUES (?, ?, ?, ?, ?)";
         $insert_product = $conn->prepare($add_product);
         $insert_product->execute([$id, $productName, $price, $rename, $category]);
         $success_msg[] = 'Produit ajouté !';
      } catch (PDOException $e) {
         // Gestion des erreurs de base de données
         $warning_msg[] = 'Erreur de base de données : ' . $e->getMessage();
      }
      
   }

}