<?php

// Vérification et affichage des messages de succès s'ils existent
if(isset($success_msg)){
   foreach($success_msg as $success_msg){
      echo '<script>swal("'.$success_msg.'", "" ,"success");</script>';
   }
}

// Vérification et affichage des messages d'avertissement s'ils existent
if(isset($warning_msg)){
   foreach($warning_msg as $warning_msg){
      echo '<script>swal("'.$warning_msg.'", "" ,"warning");</script>';
   }
}

// Vérification et affichage des messages d'information s'ils existent
if(isset($info_msg)){
   foreach($info_msg as $info_msg){
      echo '<script>swal("'.$info_msg.'", "" ,"info");</script>';
   }
}

// Vérification et affichage des messages d'erreur s'ils existent
if(isset($error_msg)){
   foreach($error_msg as $error_msg){
      echo '<script>swal("'.$error_msg.'", "" ,"error");</script>';
   }
}