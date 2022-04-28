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

    <h1>Liste des cours</h1>

        <?php if(isset($cours)): ?>
            <div class="allCours">
                <?php while($lecours = $cours->fetch()) : ?>
                    <div class="cours">
                        <h2><?=$lecours['titre']?></h2>
                        <p class="description"><?=$lecours['description']?></p>
                        <div class="info">
                            <p>Source : <a href="<?= $lecours['source']?>"><?= $lecours['source']?></a></p>
                            <p>Date de création : <?= $lecours['date_creation']?> </p>
                            <p>Dernière modification : <?= $lecours['date_modif']?></p>
                        </div>
                        <?php if($lecours['statut'] == 'active'): ?>
                            <a href="index.php?location=leCours&idCours=<?=$lecours['id']?>">Acceder au cours</a>
                        <?php else: ?>
                            <p>Ce cours sera disponible très prochainement !! Merci pour votre compréhension.</p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>


</body>
</html>