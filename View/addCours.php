<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/cours.css?ts=<?=time()?>">
    <title>Cours</title>
</head>
<body>
    <?php require('header.php'); ?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>
    
    <form action="index.php?location=addingCours" method="post">
        <fieldset>
            <legend>Ajouter un nouveau cours</legend>
            <label for="">Titre : </label> 
            <input type="text" name="title" placeholder="Saisir ici le titre du cours" required="required">
            <br>
            <label for="">Description : </label> <br>
            <textarea name="desc" id="" placeholder="Saisir ici une description du cours"></textarea>
            <br>
            <label for="">Source : </label>
            <input type="text" name="source" placeholder="Indiquer ici une source">
            <br>
            <input type="reset" value="Annuler">
            <input type="submit" value="Ajouter">
        </fieldset>
    </form>

</body>
</html>