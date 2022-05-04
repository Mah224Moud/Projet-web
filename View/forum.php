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
    <?php require('header.php'); ?>
    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <h1>Bienvenue sur le forum</h1>


    <h2><a href="index.php?location=home">Accueil</a> > Forum</h2>

    
    <?php if(isset($_SESSION['connected'])) :?>
        <h2 class="info-form">Créer une question</h2>
        <div class="form">
            <form action="index.php?location=questions" method="post">
                <fieldset>
                    <label for="">Titre: </label><input type="text" name="title" id="" placeholder="Titre"><br>
                    <?php if(isset($errors['title'])) :?>
                        <p class="errors"><?=$errors['title']?></p>
                    <?php endif ?>


                    <textarea name="content" id="" cols="30" rows="10" placeholder="Ecrire le contenu de votre question ici !!!"></textarea><br>
                    <?php if(isset($errors['content'])) :?>
                        <p class="errors"><?=$errors['content']?></p>
                    <?php endif ?>


                    <div class="submit">
                        <input type="reset" value="Annuler"><input type="submit" value="Publier"><br>
                    </div>
                    Tous les champs sont obligatoires
                </fieldset>
            </form>
        </div>
    <?php else: ?>
        <h2><a href="index.php?location=login">Créer une question</a></h2>
    <?php endif?>

    <?php if(isset($total)): ?>
        <h2 class="total">Il y'a <?=$total['total']?> questions</h2>
    <?php endif?>
    <?php if(isset($questions)): ?>
        <div class="all">
            <div id="refresh">
                <?php while($data= $questions->fetch()) : ?>
                    <div class="questions">
                        <div class="question">
                            <a href="index.php?location=otherProfile&userID=<?=$data['userID']?>"><img class="pic" src="<?=$data['picture']?>" alt=""></a>
                            <div class="content">
                                <strong><em><?=$data['title']?></em></strong>
                                <?=$data['content']?>
                                <?php $totalComments= numberCommentsforEachQuestion($data['id']);?>
                                <p><a href="index.php?location=comment&idQuestion=<?=$data['id']?>"><?=$totalComments['total']?> Commentaires</a></p>
                            </div>
                        </div>
                        <div class="info">
                            <strong><?=$data['username']?></strong><br>
                            publié le <?=$data['date_']?>
                        </div>
                        <?php if(isset($_SESSION['connected']) && $_SESSION['id'] == $data['userID']): ?>
                            <div class="delete">
                            <a href="index.php?location=deleteQuestion&idQuestion=<?=$data['id']?>"><button>Supprimer</button></a>
                            </div>
                        <?php endif?>
                    </div>   
                <?php endwhile ?>
            </div>
        </div> 
    <?php endif?>


    <?php if(isset($status)): ?>
        <script>
            alert("<?=$status?>");
            window.location.replace('index.php?location=forum');
        </script>
    <?php endif ?>
    <?php if(isset($statusDeletedQuestion)): ?>
        <script>
            alert("<?=$statusDeletedQuestion?>");
            window.location.replace('index.php?location=forum');
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