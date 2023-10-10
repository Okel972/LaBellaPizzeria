<?php
    session_start(); // Démarre ou reprend une session existante.
?>

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

        <?php if (isset($_SESSION['success'])): ?>
        // Affichage d'une alerte de succès si la session contient une variable 'success'
            swal("<?= $_SESSION['success']; ?>", "", "success");
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
        // Affichage d'une alerte d'erreur si la session contient une variable 'errors'
            swal("<?= implode('</n>', $_SESSION['errors']); ?>", "", "error");
        <?php endif; ?>

    </script>

    <body>

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

        <!-- Inclusion d'un fichier 'alert.inc.php' pour gérer les alertes -->
        <?php include 'includes/alert.inc.php'; ?>
        
    </body>
    
</html>