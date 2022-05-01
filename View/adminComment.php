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


    <?php require('headerAdmin.php'); ?>
    <?php if(isset($_SESSION['admin_username'])) :?>
        <h2><em>Bonjour <?=$_SESSION['admin_username']?></em></h2>
    <?php endif ?>

    <h2><a href="index.php?location=adminHome">Accueil</a> > <a href="index.php?location=adminForum">Forum</a> > Commentaire</h2>

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

    <h1>Tous les Commentaires</h1>

    <?php if(isset($allComments)): ?>
        <div class="all">
            <div id="refresh">
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
                        <div class="delete">
                            <a href="index.php?location=deleteCommentByAdmin&idComment=<?=$comments['id']?>&idQuestion=<?=$question['id']?>"><button>Supprimer</button></a>
                        </div>
                    </div>
                <?php endwhile?>
            </div>
        </div>       
    <?php endif ?>



    <?php if(isset($statusDeletedComment)): ?>
        <script>
            alert("<?=$statusDeletedComment?>");
            window.location.replace('index.php?location=adminComment&idQuestion=<?=$id?>');
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