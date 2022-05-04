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
    
    <h1>Réponses du quiz</h1>
    <h2><a href="index.php">Accueil </a>> <a href="index.php?location=cours">Cours </a>> Réponses</h2>
    <form>
        <fieldset>
            <?php if(isset($fichierXml)): ?>
                <?php foreach($fichierXml as $contenu): ?>
                    <?php $i++;?>
                    <h4><?=$contenu?></h4>
                    <?php if($contenu->reponse1['check']== "vrai") :?>
                        <input type="radio" id="" checked><label for=""><?=$contenu->reponse1?></label><br>
                    <?php else: ?>
                        <input type="radio" disabled><label for="" ><?=$contenu->reponse1?></label><br>
                    <?php endif ?>

                    <?php if($contenu->reponse2['check']== "vrai") :?>
                        <input type="radio" id="" checked><label for=""><?=$contenu->reponse2?></label><br>
                    <?php else: ?>
                        <input type="radio" disabled><label for="" ><?=$contenu->reponse2?></label><br>
                    <?php endif ?>

                    <?php if($contenu->reponse3['check']== "vrai") :?>
                        <input type="radio" id="" checked><label for=""><?=$contenu->reponse3?></label><br>
                    <?php else: ?>
                        <input type="radio" disabled><label for="" ><?=$contenu->reponse3?></label><br>
                    <?php endif ?>

                <?php endforeach ?>
            <?php endif ?>
        </fieldset>

    </form>
</body>
</html>