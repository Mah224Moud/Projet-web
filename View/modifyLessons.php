<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/lessons.css?ts=<?=time()?>">
    <title>Modifier une leçon</title>
</head>
<body>
    <?php require('header.php'); ?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>
    
    <form action="index.php?location=modifyingLesson&idCours=<?=$idCours?>&idLesson=<?=$idLesson?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter une nouvelle leçon</legend>
            <label for="">Titre : </label> 
            <input type="text" name="title" value="<?php if(isset($lalesson['titre']))echo $lalesson['titre']; ?>" placeholder="Saisir ici le titre du cours" required="required">
            <br>
            <label for="">Description : </label> <br>
            <textarea name="desc" id="" placeholder="Saisir ici une description du cours">
                <?php if(isset($lalesson['description']))
                    echo $lalesson['description']; ?>
            </textarea>
            <br>
            <label for="">Fichier : </label>
            <input type="file" name="fichier" accept=".pdf">
            <br>
            <input type="reset" value="Annuler">
            <input type="submit" value="Modifier">
        </fieldset>
    </form>

</body>
</html>