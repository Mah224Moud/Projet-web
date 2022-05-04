<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
    <title>Connexion</title>
</head>
<body>
    <?php require('header.php'); ?>

    <?php if(!isset($_SESSION['connected'])) :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <h1>Bienvenue sur la page de connexion</h1>

    <h2><a href="index.php?location=home">Accueil</a> > Connexion</h2>

    <div class="form">
        <form action="index.php?location=loginCheck" method="post">
            <?php if(isset($errors['not_existed_mail'])) :?>
                <p class="errors"><?=$errors['not_existed_mail']?> voulez vous <a href="index.php?location=signUp">créez un compte ?</a></p>
            <?php endif ?>

            <fieldset>
                <legend>Connexion</legend>
                <!--Email-->
                <label for="">*Email: </label><input type="email" name="email" id="" placeholder="monmail@example.com" value="<?= $_POST['email'] ?? '' ?>"><br>
                <?php if(isset($errors['email'])) :?>
                    <p class="errors"><?=$errors['email']?></p>
                <?php endif ?>

                <!--Mot de passe-->
                <label for="">*Mot de passe: </label><input type="password" name="password" id="" placeholder="Mot de passe"><br>
                <?php if(isset($errors['password'])) :?>
                    <p class="errors"><?=$errors['password']?></p>
                <?php endif ?>

                <div class="submit">
                    <input type="reset" value="Annuler"><input type="submit" value="Connexion">
                </div> <br>
                Tous les champs marqués d'une * sont obligatoires <br>
                Vous n'avez pas de compte? <a href="index.php?location=signUp">Inscrivez-vous</a>
            </fieldset>
        </form>
    </div>
</html>