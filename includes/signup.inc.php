<?php

// Vérifie si le formulaire d'inscription a été soumis (c'est-à-dire si le bouton "submit" a été cliqué)
if (isset($_POST["submit"])) {
    
    // Récupère et sécurise les données du formulaire
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $username = htmlspecialchars($_POST["uid"]);
    $pwd = htmlspecialchars($_POST["pwd"]);
    $pwdRepeat = htmlspecialchars($_POST["pwdrepeat"]);

    // Inclut les fichiers nécessaires contenant des fonctions et la connexion à la base de données
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Vérifie si les champs du formulaire sont vides en utilisant la fonction emptyInputSignup
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        // Redirige l'utilisateur vers la page d'inscription avec un message d'erreur
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    
    // Vérifie si le nom d'utilisateur est valide en utilisant la fonction invalidUid
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invalidUid");
        exit();
    }

    // Vérifie si l'adresse e-mail est valide en utilisant la fonction invalidEmail
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }

    // Vérifie si les mots de passe saisis correspondent en utilisant la fonction pwdMatch
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    // Vérifie si le nom d'utilisateur ou l'adresse e-mail existent déjà en utilisant la fonction uidExists
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    // Crée l'utilisateur en utilisant la fonction createUser
    createUser($conn, $name, $email, $username, $pwd);
}
else {
    // Si le formulaire n'a pas été soumis, redirige simplement vers la page d'inscription
    header("location: ../signup.php");
}