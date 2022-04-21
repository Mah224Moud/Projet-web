<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/comment.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
    <title>Commentaire</title>
</head>
<body>
    <?php require('header.php'); ?>
    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <h2><a href="index.php?location=home">Accueil</a> > <a href="index.php?location=forum">Forum</a> > Commentaire</h2>


    <?php if(isset($question)): ?>
        <div class="questions">
            <div class="question">
                <img class="pic" src="<?=$question['picture']?>" alt="">
                <div class="content">
                    <strong><em><?=$question['title']?></em></strong>
                    <?=$question['content']?>
                </div>
            </div>
            <div class="info">
                <strong><?=$question['username']?></strong><br>
                publié le <?=$question['date_']?>
            </div>
        </div>   
    <?php endif?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2 class="info-form">Ecrire un commentaire</h2>
        <form action="index.php?location=publishComment&amp;idQuestion=<?=$question['id']?>&amp;idUser=<?=$_SESSION['id']?>" method="post">
                <textarea name="content" id="" cols="35" rows="5" placeholder="Ecrire de votre commentaire ici !!!"></textarea><br>
                <?php if(isset($errors['content'])) :?>
                    <p class="errors"><?=$errors['content']?></p>
                <?php endif ?>

                <input type="reset" value="Annuler"><input type="submit" value="Publier"><br><br>
        </form>
    <?php else: ?>
        <h2 class="info-form"><a href="index.php?location=login">Ecrire un commentaire</a></h2>
    <?php endif?>

    <h1>Tous les Commentaires</h1>

    <?php if(isset($allComments)): ?>
        <div class="all">
        <?php while($comments= $allComments->fetch()): ?>
            <?php $member=  identifiedMember($comments['userID']);?>
            <div class="questions">
                <div class="question">
                    <img class="pic" src="<?=$member['picture']?>" alt="">
                    <div class="content-comment">
                        <?=$comments['comment']?>
                    </div>
                </div>
                <div class="info">
                    <strong><?=$member['username']?></strong><br>
                    publié le <?=$comments['date_']?>
                </div>
            </div>
        <div>  
        <?php endwhile?>
    <?php endif ?>


    <?php if(isset($status)): ?>
        <script>
            alert("<?=$status?>");
            window.location.replace('index.php?location=comment&idComment=<?=$question['id']?>');
        </script>
    <?php endif ?>
</body>
</html>