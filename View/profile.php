<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/profile.css?ts=<?=time()?>">

    <title>Profile</title>
</head>
<body>
    <?php if(isset($_SESSION['connected'])): ?>
        <h2><a href="index.php">Accueil</a> > <?=$_SESSION['username']?></h2>
    <?php endif ?>
    <h1>Bienvenue sur ton profil</h1>
    <div id="button">
        <a href="index.php?location=modify"><button id="modify">Modifier</button></a>
        <a href="index.php?location=logout"><button id="disconnect">Déconnexion</button></a>
    </div>
    <div id="profile">
        <div id="me">
            <img src="<?=$_SESSION['picture']?>" alt="">
            <span><strong><em><?=$_SESSION['username']?></em></strong></span>
        </div>
        <div id="about">
            <h1>A propos de moi</h1>
            <p><?=strtoupper($_SESSION['firstName'])?> <?=$_SESSION['lastName']?></p>
            <p>Né(e) le: <em><?=$_SESSION['birthday']?></em></p>
            <p>Email: <em><?=$_SESSION['email']?></em></p>
        </div>
        <div id="courses">
            <h1>Cours</h1>
            liste des cours
        </div>
        <div id="infos">
            <h1>Informations du compte</h1>
            <p>Inscrit le: <em><?=$_SESSION['inscription_date']?></em></p>
        </div>
    </div>
    
</body>
</html>