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
                <a href="index.php?location=otherProfile&userID=<?=$question['userID']?>"><img class="pic" src="<?=$question['picture']?>" alt=""></a>
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

                <input type="reset" value="Annuler"><input type="submit" value="Publier"><br>
        </form>
    <?php else: ?>
        <h2 class="info-form"><a href="index.php?location=login">Ecrire un commentaire</a></h2>
    <?php endif?>

    <h1>Tous les Commentaires</h1>

    <?php if(isset($allComments)): ?>
        <div class="all">
            <div id="refresh">
                <?php while($comments= $allComments->fetch()): ?>
                    <?php $member=  identifiedMember($comments['userID']);?>
                    <div class="questions">
                        <div class="question">
                            <a href="index.php?location=otherProfile&userID=<?=$comments['userID']?>"><img class="pic" src="<?=$member['picture']?>" alt=""></a>
                            <div class="content-comment">
                                <?=$comments['comment']?>
                            </div>
                        </div>
                        <div class="info">
                            <strong><?=$member['username']?></strong><br>
                            publié le <?=$comments['date_']?>
                        </div>
                        <?php if(isset($_SESSION['connected']) && $_SESSION['id'] == $member['id']): ?>
                            <div class="delete">
                                <a href="index.php?location=deleteComment&idComment=<?=$comments['id']?>&idQuestion=<?=$question['id']?>"><button>Supprimer</button></a>
                            </div>
                        <?php endif?>
                    </div>
                <?php endwhile?>
            </div>
        </div>  
    <?php endif ?>


    <?php if(isset($status)): ?>
        <script>
            alert("<?=$status?>");
            window.location.replace('index.php?location=comment&idQuestion=<?=$question['id']?>');
        </script>
    <?php endif ?>
    <?php if(isset($statusDeletedComment)): ?>
        <script>
            alert("<?=$statusDeletedComment?>");
            window.location.replace('index.php?location=comment&idQuestion=<?=$id?>');
        </script>
    <?php endif ?>


    <script src="./Public/JS/jquery.js"></script>
    <script>
        $(document).ready(()=>{
            $('#refresh').load(location.href + " #refresh");
                setInterval(function(){
                    $('#refresh').load(location.href + " #refresh");
                }, 1000);
        })
    </script>
</body>
</html>