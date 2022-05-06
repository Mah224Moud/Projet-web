<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/quiz.css?ts=<?=time()?>">
    <title>Quiz</title>
</head>
<body>
    <?php require('header.php'); ?>
    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php endif ?>
    
    <h1>Quiz de détermination de niveau</h1>
    <h2><a href="index.php">Accueil </a>> <a href="index.php?location=cours">Cours </a>> Quiz</h2>

    <?php if(isset($errors['emptyCase'])): ?>
        <p class="errors"><?=$errors['emptyCase']?></p>
    <?php endif ?>
    <form action="index.php?location=quizCheck" method="POST">
        <fieldset>
            <?php if(isset($fichierXml)): ?>
                <?php foreach($fichierXml as $contenu): ?>
                    <?php $i++;?>
                    <h4><?=$contenu?></h4>
                    <input type="radio" name="reponse<?=$i?>" id="" value="<?=$contenu->reponse1['check']?>"><label for=""><?=$contenu->reponse1?></label><br>
                    <input type="radio" name="reponse<?=$i?>" id="" value="<?=$contenu->reponse2['check']?>"><label for=""><?=$contenu->reponse2?></label><br>
                    <input type="radio" name="reponse<?=$i?>" id="" value="<?=$contenu->reponse3['check']?>"><label for=""><?=$contenu->reponse3?></label><br>
                <?php endforeach ?>
            <?php endif ?>
            <div class="submit">
                <input type="reset" value="Annuler"> <input type="submit" value="Envoyer">
            </div>
        </fieldset>
    </form>
    <?php if(isset($result)): ?>
        <script>
            alert("Vous avez obtenu un resultat de <?=$result?>%");
            window.location.replace('index.php?location=quizResult');
        </script>
    <?php endif ?>
</body>
</html>