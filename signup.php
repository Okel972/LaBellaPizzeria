<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogIn</title>
        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/signup-style.css">
    </head>

    <body>

        <?php $page = ''; include('header.php'); ?>

        <!-- Section principale de la page -->
        <section class="wrapper">

            <!-- Div contenant le formulaire d'inscription -->
            <div class="form-box register">

                <!-- Titre du formulaire -->
                <h2>Registration</h2>

                <!-- Formulaire qui envoie les données à "signup.inc.php" -->
                <form action="includes/signup.inc.php" method="post">

                <!-- Champs de saisie pour le nom, l'e-mail, le nom d'utilisateur et le mot de passe -->
                    <div class="input-box">
                        <input type="text" name="name"> <!-- NOM -->
                        <label>Full name</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="email"> <!-- EMAIL -->
                        <label>Email</label>
                    </div>

                    <div class="input-box">
                        <input type="text" name="uid"> <!-- PSEUDO -->
                        <label>Username</label>
                    </div>

                    <div class="input-box">
                        <input type="password" name="pwd"> <!-- MOT DE PASSE -->
                        <label>Password</label>
                    </div>

                    <div class="input-box">
                        <input type="password" name="pwdrepeat"> <!-- CONFIRMATION MOT DE PASSE -->
                        <label>Confirm password</label>
                    </div>

                    <!-- Case à cocher pour accepter les conditions générales -->
                    <div class="remember-forgot">
                        <label><input type="checkbox">I agree to terms & conditions</label>
                    </div>

                    <!-- Bouton de soumission du formulaire -->
                    <button type="submit" name="submit" class="btn">Signup</button>

                    <!-- Lien pour rediriger vers la page de connexion -->
                    <div class="login-register">
                        <p>Already have an account? <a href="login.php" class="login-link">Login</a></p>
                    </div>

                </form>

            </div>

            <?php
                // Gestion des messages d'erreur provenant de "signup.inc.php"
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        $warning_msg[] = 'Fill in all fields';
                    }
                    else if ($_GET["error"] == "invalidUid") {
                        $warning_msg[] = 'choose a proper username';
                    }
                    else if ($_GET["error"] == "invalidEmail") {
                        $warning_msg[] = 'choose a proper email';
                    }
                    else if ($_GET["error"] == "passwordsdontmatch") {
                    $warning_msg[] = "Passwords don't match";
                    }
                    else if ($_GET["error"] == "stmtfailed1" || $_GET["error"] == "stmsfailed2"  || $_GET["error"] == "stmsfailed3") {
                    $warning_msg[] = 'Something went wrong, please try again';
                    }
                    else if ($_GET["error"] == "usernametaken") {
                        $warning_msg[] = 'Username already taken';
                    }
                }
            ?>

        </section>

        <!-- Inclusion de la bibliothèque JavaScript sweetAlert pour afficher des messages d'alerte -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- Inclusion du code de gestion des messages d'alerte depuis "alert.inc.php" -->
        <?php include 'includes/alert.inc.php'; ?>

        <?php include('footer.php'); ?>

    </body>

</html>