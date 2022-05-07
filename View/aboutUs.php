<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/home.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/aboutUs.css?ts=<?=time()?>">
    <title>A propos de nous</title>
</head>
<body>
    <?php require('header.php'); ?>
    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <h2><a href="index.php">Accueil</a> > A propos de nous</h2>

    <h1>A propos de nous</h1>
    <div class="aboutUs">
        <p>Nous sommes des étudiant.e.s en Licence 3 Informatique à l'Université de <em>Bourgogne</em></p>
        <p>Nous avons développé ce site de cours en ligne dans le cadre d'un projet scolaire</p>
        <p>Les différents membres sont:</p>
        <p class="member">
            CAMARA Mamadou <br>
            <em>Email : Mamadou_Camara@etu.u-bourgogne.fr</em>
        </p>
        <p class="member">
            BAH Saikou Oumar <br>
            <em>Email : Saikou_Bah@etu.u-bourgogne.fr</em>
        </p>
        <p class="member">
            DIALLO Mamoudou <br>
            <em>Email : Mamoudou_Diallo01@etu.u-bourgogne.fr</em>
        </p>
        <p class="member">
            AIT BEN ALI Ilham <br>
            <em>Email : </em>
        </p>
        <p class="member">
            CEM Edizem <br> 
            <em>Email : </em>
        </p>
        <p class="member">
            Talla LOUM <br> 
            <em>Email : </em>
        </p>

        </div>
    
</body>
</html>