<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/lessons.css?ts=<?=time()?>">
    <title>Ajouter une lesson</title>
</head>
<body>
    <?php require('headerAdmin.php'); ?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>
    
    <form action="index.php?location=addingLesson&idCours=<?=$idCours?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter une nouvelle leçon</legend>
            <label for="">Titre : </label> 
            <input type="text" name="title" placeholder="Saisir ici le titre du cours" required="required">
            <br>
            <label for="">Description : </label> <br>
            <textarea name="desc" id="" placeholder="Saisir ici une description du cours"></textarea>
            <br>
            <label for="">Fichier : </label>
            <input type="file" name="fichier" accept=".pdf">
            <br>
            <input type="reset" value="Annuler">
            <input type="submit" value="Ajouter">
        </fieldset>
    </form>

</body>
</html>