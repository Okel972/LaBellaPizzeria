<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="refresh" content="3"> -->
        <link rel="stylesheet" href="style/formulaireDeContact-style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <title>FormulaireDeContact</title>
    </head>

    <script>

        <?php if (isset($_SESSION['errors'])): ?>

        <?php
            // Récupérez les erreurs depuis la session
            $errors = $_SESSION['errors'];

            // Créez une chaîne de texte formatée pour les erreurs
            $errorText = implode($errors); // Vous pouvez utiliser un séparateur de votre choix

            // Utilisez cette chaîne dans votre boîte de dialogue Swal
            echo "swal(
                '$errorText',
                'Please make sure to fill out everything correctly.',
                'error'
            );";
        ?>

        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>

        <?php
            // Utilisez cette chaîne dans votre boîte de dialogue Swal
            echo "swal(
                'Votre email a bien été envoyé',
                'Super !',
                'success'
            );";
        ?>

        <?php endif; ?>

        <?php unset($_SESSION['errors']); ?>
        <?php unset($_SESSION['success']); ?>

    </script>

    <body>

        <!-- Une formule qui marche bien -->
        <!-- 
        <?php if(isset($_SESSION['errors'])): ?>
            <div>
                <?= implode($_SESSION['errors']);?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['success'])): ?>
            <div>
                Votre email a bien été envoyé
            </div>
        <?php endif; ?>
        -->


        <div>

            <div>

            <!-- Formulaire de contact avec action dirigée vers "includes/contact.inc.php" en utilisant la méthode POST -->
                <form action="includes/contact.inc.php" method="POST">

                    <div class="contact">

                        <div class="title">Envoyez-nous un message</div>

                        <div class="contact-content">

                            <div>
                            <!-- Champ pour le nom -->
                                <input type="text" name="nameContact" id="inputName" class="nom" placeholder="Nom" value="<?= isset($_SESSION['inputs']['nameContact']) ? $_SESSION['inputs']['nameContact'] : ''; ?>">
                            </div>

                            <div>
                            <!-- Champ pour l'email -->
                                <input type="text" name="emailContact" id="inputEmail" class="email" placeholder="Email" value="<?= isset($_SESSION['inputs']['emailContact']) ? $_SESSION['inputs']['emailContact'] : ''; ?>">
                            </div>

                            <div>
                            <!-- Sélection du service -->
                                <select name="service" id="inputService" class="sujet">
                                    <option value="0">Contact</option>
                                    <option value="1">Commandes</option>
                                    <option value="2">Informations</option>
                                </select>
                            </div>

                            <div>
                            <!-- Champ pour le message -->
                                <textarea name="messageContact" id="inputMessage" class="comment" placeholder="Message"><?= isset($_SESSION['inputs']['messageContact']) ? $_SESSION['inputs']['messageContact'] : ''; ?></textarea>
                            </div>

                            <button type="submit" class="bouton-envoyer">Envoyer</button>

                        </div>
                        
                    </div>

                </form>

            </div>

        </div>

        <!-- Inclusion de la bibliothèque JavaScript sweetAlert pour afficher des messages d'alerte -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.js"></script>
        
    </body>
    
</html>