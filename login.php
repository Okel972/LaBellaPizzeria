<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogIn</title>
        <link href="https://fonts.googleapis.com/css2?family=Geologica&family=Inter&family=Paprika&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/login-style.css">
    </head>

    <body>

        <?php $page = ''; include('header.php'); ?>

        <!-- Section principale de la page de connexion -->
        <section class="wrapper">

            <!-- Boîte de formulaire pour la connexion -->
            <div class="form-box login">

                <h2>Login</h2>

                <!-- Formulaire de connexion avec action vers 'includes/login.inc.php' et méthode POST -->
                <form action="includes/login.inc.php" method="post">

                    <!-- Champ de saisie pour le nom d'utilisateur ou l'email -->
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="text" name="uid">
                        <label>Username/Email</label>
                    </div>

                    <!-- Champ de saisie pour le mot de passe -->
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="password" name="pwd">
                        <label>Password</label>
                    </div>

                    <!-- Cases à cocher pour "Remember me" et lien "Forgot Password?" -->
                    <div class="remember-forgot">
                        <label><input type="checkbox">Remember me</label>
                        <a href="#">Forgot Password?</a>
                    </div>
    
                    <!-- Bouton de soumission du formulaire -->
                    <button type="submit" name="submit" class="btn">Login</button>

                    <!-- Lien pour rediriger vers la page d'inscription -->
                    <div class="login-register">
                        <p>Don't have an account? <a href="signup.php" class="register-link">Register</a></p>
                    </div>

                </form>

            </div>

            <!-- Vérification des paramètres GET pour afficher un message -->
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        $warning_msg[] = 'Fill in all fields';
                    }
                    else if ($_GET["error"] == "wronglogin") {
                        $warning_msg[] = 'Incorrect login information';
                    }
                    else if ($_GET["error"] == "wrongpassword") {
                        $warning_msg[] = 'Incorrect password';
                    }
                    else if ($_GET["error"] == "none") {
                        $success_msg[] = 'You have signed up';
                    }
                }
            ?>

        </section>

        <!-- Inclusion de la bibliothèque JavaScript sweetAlert pour afficher des messages d'alerte -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- Inclusion d'un fichier 'alert.inc.php' pour gérer les alertes -->
        <?php include 'includes/alert.inc.php'; ?>

        <?php include('footer.php'); ?>

    </body>

</html>