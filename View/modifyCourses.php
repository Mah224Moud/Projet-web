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
    
    <form action="index.php?location=modifyingCours&idCours=<?php if(isset($idcours)) echo $idcours; ?>" method="post">
        <fieldset>
            <legend>Ajouter un nouveau cours</legend>
            <label for="">Titre : </label> <br>
            <input type="text" name="title" placeholder="Saisir ici le titre du cours" value="<?php if(isset($lecours['titre'])) echo $lecours['titre']; ?>" required="required">
            <br>
            <label for="">Description : </label> <br>
            <textarea name="desc" id="" placeholder="Saisir ici une description du cours">
                <?php if(isset($lecours['description'])) 
                    echo $lecours['description']; ?>
            </textarea>
            <br>
            <label for="">Niveau</label> <br>
            <input type="number" name="niveau" min="0" max="100" value = "<?php if(isset($lecours['points'])) echo $lecours['points']; ?>">
            <br>
            <label for="">Source : </label> <br>
            <input type="text" name="source" value="<?php if(isset($lecours['source'])) echo $lecours['source']; ?>" placeholder="Indiquer ici une source">
            <br>
            <input type="reset" value="Annuler">
            <input type="submit" value="Valider">
        </fieldset>
    </form>

</body>
</html>