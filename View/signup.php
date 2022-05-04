<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
</head>
<body>
    <?php require('header.php'); ?>

    <h1>Bienvenue sur la page d'inscription</h1>

    <h2><a href="index.php?location=home">Accueil</a> > <a href="index.php?location=login">Connexion</a> > Inscription</h2>

    <div class="form">
        <form action="index.php?location=signUpCheck" method="POST" enctype="multipart/form-data">
            <?php if(isset($errors['existed_mail'])) :?>
                <p class="errors"><?=$errors['existed_mail']?></p>
            <?php endif ?>
            <?php if(isset($errors['existed_username'])) :?>
                <p class="errors"><?=$errors['existed_username']?></p>
            <?php endif ?>

            <fieldset>
                <legend>Inscription</legend>
                <!--Civilité-->
                <label for="">*Civilité: </label>
                <label for="gender">Mr</label><input type="radio" name="gender" id="" value="Mr">
                <label for="gender">Mme</label><input type="radio" name="gender" id="" value="Mlle/Mme"><br>
                <?php if(isset($errors['gender'])) :?>
                    <p class="errors"><?=$errors['gender']?></p>
                <?php endif ?>

                <!--Nom-->
                <label for="">*Nom: </label><input type="text" name="firstName" id="" placeholder="Nom" value="<?= $_POST['firstName'] ?? '' ?>"><br>
                <?php if(isset($errors['firstName'])) :?>
                    <p class="errors"><?=$errors['firstName']?></p>
                <?php endif ?>

                <!--Prenom-->
                <label for="">*Prénom: </label><input type="text" name="lastName" id="" placeholder="Prénom" value="<?= $_POST['lastName'] ?? '' ?>"><br>
                <?php if(isset($errors['lastName'])) :?>
                    <p class="errors"><?=$errors['lastName']?></p>
                <?php endif ?>

                <!--Date de naissance-->
                <label for="">*Date de naissance: </label><input type="date" name="birthday" id="" placeholder="Date" value="<?= $_POST['birthday'] ?? '' ?>"><br>
                <?php if(isset($errors['birthday'])) :?>
                    <p class="errors"><?=$errors['birthday']?></p>
                <?php endif ?>

                <!--Photo-->
                <label for="">Photo de profil: </label><input type="file" name="picture" id=""><br>
                <?php if(isset($errors['picture_size'])) :?>
                    <p class="errors"><?=$errors['picture_size']?></p>
                <?php endif ?>
                <?php if(isset($errors['picture_extension'])) :?>
                    <p class="errors"><?=$errors['picture_extension']?></p>
                <?php endif ?>

                <!--Email-->
                <label for="">*Email: </label><input type="email" name="email" id="" placeholder="monmail@example.com" value="<?= $_POST['email'] ?? '' ?>"><br>
                <?php if(isset($errors['email'])) :?>
                    <p class="errors"><?=$errors['email']?></p>
                <?php endif ?>

                <!--Pseudo-->
                <label for="">*Pseudo: </label><input type="text" name="username" id="" placeholder="Pseudo" value="<?= $_POST['username'] ?? '' ?>"><br>
                <?php if(isset($errors['username'])) :?>
                    <p class="errors"><?=$errors['username']?></p>
                <?php endif ?>

                <!--Mot de passe-->
                <label for="">*Mot de passe: </label><input type="password" name="password" id="" placeholder="Mot de passe"><br>
                <?php if(isset($errors['password'])) :?>
                    <p class="errors"><?=$errors['password']?></p>
                <?php endif ?>

                <!--Confimation-->
                <label for="">*Confirmation: </label><input type="password" name="confirmPassword" id="" placeholder="Confirmer votre mot de passe"><br>
                <?php if(isset($errors['confirmPassword'])) :?>
                    <p class="errors"><?=$errors['confirmPassword']?></p>
                <?php endif ?>
                <?php if(isset($errors['differentsPassword'])) :?>
                    <p class="errors"><?=$errors['differentsPassword']?></p>
                <?php endif ?>

                <div class="submit">
                    <input type="reset" value="Annuler"><input type="submit" value="S'inscrire">
                </div><br>
                Tous les champs marqués d'une * sont obligatoires <br>
                Vous avez un compte? <a href="index.php?location=login">Connectez-vous</a>
            </fieldset>
        </form>
    </div>

    <?php if(isset($checked)) :?>
        <script>
            alert("<?=$checked?>");
        </script>
    <?php endif ?>
    <?php if(isset($createdAcount)) :?>
        <script>
            window.location.replace("index.php?location=login");
        </script>
    <?php endif ?>
</body>
</html>