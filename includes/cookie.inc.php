<?php

// Vérification de l'existence du cookie 'user_id'
if(isset($_COOKIE['user_id'])){
   // Si le cookie existe, récupère sa valeur et la stocke dans la variable $user_id
   $user_id = $_COOKIE['user_id'];
}
else {
   // Crée un nouveau cookie 'user_id' avec la valeur de l'identifiant unique
   // Le cookie expire dans 30 jours (60 secondes * 60 minutes * 24 heures * 30 jours)
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}