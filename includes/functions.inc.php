<?php
// Fonction pour vérifier si des champs d'inscription sont vides
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}






// Fonction pour vérifier si le nom d'utilisateur est valide
function invalidUid($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}






// Fonction pour vérifier si l'adresse email est valide
function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}






// Fonction pour vérifier si les mots de passe correspondent
function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}






// Fonction pour vérifier si un nom d'utilisateur ou une adresse email existe déjà dans la base de données
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed1");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}







// Fonction pour créer un nouvel utilisateur dans la base de données
function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed2");
        exit();
    }

    $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);

    // essai pour hacher l'email
    // $secret = sha1($email).time();
    // $secret = sha1($secret).time();

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $pwdHashed);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();
}







// Fonction pour vérifier si des champs de connexion sont vides
function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}







// Fonction pour connecter un utilisateur
function loginUser($conn, $username, $pwd) {
    // Vérifie si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed3");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        // Vérifie si le mot de passe saisi correspond au mot de passe haché dans la base de données
        $passwordCheck = password_verify($pwd, $row["usersPwd"]);
        if ($passwordCheck === false) {
            header("location: ../login.php?error=wrongpassword");
            exit();
        } elseif ($passwordCheck === true) {
            session_start();
            $_SESSION["userid"] = $row["usersId"];
            $_SESSION["useruid"] = $row["usersUid"];
            header("location: ../index.php?error=connected");
            exit();
        }
    } else {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
}








// $pwdHashed = $uidExists["usersPwd"];
// $checkPwd = password_verify($pwd, $pwdHashed);

// if ($checkPwd === false) {
//     header("location: ../login.php?error=wrongpassword");
//     exit();
// }
// else if ($checkPwd === true) {
//     session_start();
//     $_SESSION["userid"] = $uidExists["usersId"];
//     $_SESSION["useruid"] = $uidExists["usersUid"];
//     header("location: ../index.php");
//     exit();
// }







// Fonction pour générer un identifiant unique
function create_unique_id(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}








// function totalCartItems($conn, $userId): int {
//     $sql = "SELECT * FROM cart WHERE user_Uid = ?;";
//     $stmt = mysqli_stmt_init($conn);
//     if (!mysqli_stmt_prepare($stmt, $sql)) {
//         header("location: ../index.php?error=err");
//         exit();
//     }

//     mysqli_stmt_bind_param($stmt, "s", $userId);
//     mysqli_stmt_execute($stmt);

//     $resultData = mysqli_stmt_get_result($stmt);

//     $total_cart_items = mysqli_num_rows($resultData);

//     mysqli_stmt_close($stmt);

//     return $total_cart_items;
// }







// Fonction pour vérifier si des champs de formulaire de contact sont vides
function emptyInputContact($nameContact, $emailContact, $messageContact) {
    $result;
    if(empty($nameContact) || empty($emailContact) || empty($messageContact)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}