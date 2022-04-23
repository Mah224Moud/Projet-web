<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/forum.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
    <title>Forum</title>
</head>
<body>
    <?php require('headerAdmin.php'); ?>
    <?php if(isset($_SESSION['admin_username'])) :?>
        <h2><em>Bonjour <?=$_SESSION['admin_username']?></em></h2>
    <?php endif ?>

    <h1>Bienvenue sur le forum admin</h1>


    <h2><a href="index.php?location=adminHome">Accueil</a> > Forum</h2>

    <?php if(isset($total)): ?>
        <h2 class="total">Il y'a <?=$total['total']?> questions</h2>
    <?php endif?>
    <?php if(isset($questions)): ?>
        <div class="all">
            <div id="refresh">
                <?php while($data= $questions->fetch()) : ?>
                    <div class="questions">
                        <div class="question">
                            <img class="pic" src="<?=$data['picture']?>" alt="">
                            <div class="content">
                                <strong><em><?=$data['title']?></em></strong>
                                <?=$data['content']?>
                                <?php $totalComments= numberCommentsforEachQuestion($data['id']);?>
                                <p><a href="index.php?location=adminComment&idQuestion=<?=$data['id']?>"><?=$totalComments['total']?> Commentaires</a></p>
                            </div>
                        </div>
                        <div class="info">
                            <strong><?=$data['username']?></strong><br>
                            publié le <?=$data['date_']?>
                        </div>
                        <div class="delete">
                            <a href="index.php?location=deleteQuestionByAdmin&idQuestion=<?=$data['id']?>"><button>Supprimer</button></a>
                        </div>
                    </div>   
                <?php endwhile ?>
            </div>
        </div> 
    <?php endif?>


    <?php if(isset($statusDeletedQuestion)): ?>
        <script>
            alert("<?=$statusDeletedQuestion?>");
            window.location.replace('index.php?location=adminForum');
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