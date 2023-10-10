<?php
// Vérifie si le formulaire de connexion a été soumis
if (isset($_POST["submit"])) {
    // Récupère le nom d'utilisateur et le mot de passe saisis par l'utilisateur
    $username = htmlspecialchars($_POST["uid"]);
    $pwd = htmlspecialchars($_POST["pwd"]);

    // Inclut les fichiers nécessaires contenant les fonctions et la configuration de la base de données
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Vérifie si des champs sont vides en utilisant la fonction emptyInputLogin définie dans functions.inc.php
    if (emptyInputLogin($username, $pwd) !== false) {
        // Redirige vers la page de connexion avec un message d'erreur si des champs sont vides
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    // Appelle la fonction loginUser pour tenter de connecter l'utilisateur
    loginUser($conn, $username, $pwd);

}
else {
    // Redirige vers la page de connexion si le formulaire n'a pas été soumis
    header("location: ../login.php");
    exit();
}