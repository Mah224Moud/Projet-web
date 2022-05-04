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
    <?php require('headerAdmin.php'); ?>
    <?php if(isset($_SESSION['admin_username'])) :?>
        <h2><em>Bonjour <?=$_SESSION['admin_username']?></em></h2>
    <?php endif ?>
    <h1>Bienvenue sur la page d'admin</h1>
    

    <div id="mainPage">
        <a href="index.php?location=allMembers">
            <img src="./Public/Image/members.png" alt="">
            <div id="members">Members</div>
        </a>
        <a href="index.php?location=signal">
            <img src="./Public/Image/news.png" alt="">
            <div id="signal">Signal</div>
        </a>
        <a href="index.php?location=adminForum">
            <img src="./Public/Image/chat.png" alt="">
            <div id="forum">Forum</div>
        </a>
        <a href="index.php?location=adminCourses">
            <img src="./Public/Image/cours.jpg" alt="">
            <div id="cours">Cours</div>
        </a>
    </div>
    
</body>
</html>