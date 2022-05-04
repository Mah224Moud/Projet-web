<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/home.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <title>Accueil</title>
</head>
<body>
    <?php require('header.php'); ?>
    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <h1>Bienvenue sur la page d'accueil</h1>

    


    <div id="mainPage">
        <a href="index.php?location=cours">
            <img src="./Public/Image/cours.jpg" alt="">
            <div id="cours">Cours</div>
        </a>
        <a href="index.php?location=forum">
            <img src="./Public/Image/chat.png" alt="">
            <div id="forum">Forum</div>
        </a>
        <?php if(isset($_SESSION['connected'])) :?>
            <a href="index.php?location=logout">
                <img src="./Public/Image/logout.png" alt="">
                <div id="logout">Déconnexion</div>
            </a>
        <?php else: ?>
            <a href="index.php?location=login">
                <img src="./Public/Image/login.jpg" alt="">
                <div id="login">Connexion</div>
            </a>
        <?php endif ?>
    </div>




    <footer>
        <a href="index.php?location=contactUs">Nous contacter</a>
        <a href="index.php?location=aboutUs">Qui sommes-nous ?</a>
    </footer>

    <?php if(isset($logout)) :?>
        <script>
            alert("Ce n'est qu'un aurevoir à très bientôt :) ");
            window.location.replace("index.php");
        </script>
    <?php endif ?>
</body>
</html>