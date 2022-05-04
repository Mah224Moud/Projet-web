<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/contactUs.css?ts=<?=time()?>">
    <title>Nous contacter</title>
</head>
<body>
    <?php require('header.php'); ?>
    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <h1>Bienvenue sur la page de contact</h1>

    <h2><a href="index.php?location=home">Accueil</a> > Nous contacter</h2>

    <div class="form">
        <?php if(isset($_SESSION['connected'])): ?>
            <form action="index.php?location=contactCheck" method="post">
                <fieldset>
                    <legend>Nous contacter</legend>
                    Salut <strong><em><?=$_SESSION['username']?></em></strong>, en quoi pouvons-nous vous aider ? <br>
                    <textarea name="message" id="" cols="35" rows="5" placeholder="Entrer votre message ici !!!"></textarea><br>
                    <?php if(isset($errors['message'])) :?>
                        <p class="errors"><?=$errors['message']?></p>
                    <?php endif ?>

                    <div class="submitAndReset">
                        <input type="reset" value="Annuler"> <input type="submit" value="Envoyer">
                    </div><br>
                Tous les champs sont obligatoires <br>

                </fieldset>
            </form>
        <?php else:?>
            <form action="index.php?location=contactCheck" method="post">
                <fieldset>
                    <legend>Nous contacter</legend>
                    <label for="">Nom: </label><input type="text" name="firstName" id="" placeholder="Nom"><br>
                    <?php if(isset($errors['firstName'])) :?>
                        <p class="errors"><?=$errors['firstName']?></p>
                    <?php endif ?>


                    <label for="">Prénom: </label><input type="text" name="lastName" id="" placeholder="prénom"><br>
                    <?php if(isset($errors['lastName'])) :?>
                        <p class="errors"><?=$errors['lastName']?></p>
                    <?php endif ?>


                    <label for="">Email: </label><input type="email" name="email" id="" placeholder="Email"><br>
                    <?php if(isset($errors['email'])) :?>
                        <p class="errors"><?=$errors['email']?></p>
                    <?php endif ?>


                    <label for="">Pseudo: </label><input type="text" name="username" id="" placeholder="Pseudo"><br>
                    <?php if(isset($errors['username'])) :?>
                        <p class="errors"><?=$errors['username']?></p>
                    <?php endif ?>



                    <textarea name="message" id="" cols="35" rows="5" placeholder="Entrer votre message ici !!!"></textarea><br>
                    <?php if(isset($errors['message'])) :?>
                        <p class="errors"><?=$errors['message']?></p>
                    <?php endif ?>

                    <div class="submitAndReset">
                        <input type="reset" value="Annuler"> <input type="submit" value="Envoyer">
                    </div><br>
                Tous les champs sont obligatoires <br>

                </fieldset>
            </form>
        <?php endif ?>
    </div>
    

    <?php if(isset($notSend)): ?>
        <script>alert("<?=$notSend?>");</script>
    <?php endif ?>

    <?php if(isset($isSend)): ?>
        <script>
            alert("<?=$isSend?>");
            window.location.replace("index.php");
        </script>
    <?php endif ?>

</body>
</html>