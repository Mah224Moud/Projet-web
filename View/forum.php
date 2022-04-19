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
        <h2>Créer une question</h2>
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


                <input type="reset" value="Annuler"><input type="submit" value="Publier"><br><br>
                Tous les champs sont obligatoires
            </fieldset>
        </form>
    <?php else: ?>
        <h2><a href="index.php?location=login">Créer une question</a></h2>
    <?php endif?>

    <?php if(isset($total)): ?>
        <h2 class="total">Il y'a <?=$total['total']?> questions</h2>
    <?php endif?>
    <?php if(isset($questions)): ?>
        <div class="all">
            <?php while($data= $questions->fetch()) : ?>
                <div class="questions">
                    <div class="question">
                        <img class="pic" src="<?=$data['picture']?>" alt="">
                        <div class="content">
                            <strong><em><?=$data['title']?></em></strong>
                            <?=$data['content']?>
                            <a href="">Commentaires</a>
                        </div>
                    </div>
                    <div class="info">
                        <strong><?=$data['username']?></strong><br>
                        publié le <?=$data['date_']?>
                    </div>
                </div>   
            <?php endwhile ?>
        </div> 
    <?php endif?>


    <?php if(isset($status)): ?>
        <script>alert("<?=$status?>")</script>
    <?php endif ?>
</body>
</html>