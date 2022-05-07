<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/cours.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/lessons.css?ts=<?=time()?>">
    <title>Cours</title>
</head>
<body>
    <?php require('header.php'); ?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>
    
    <?php if(isset($leCours)): ?>
        <?php while($lecours = $leCours->fetch()) : ?>
            <h2><a href="index.php">Accueil </a>> <a href="index.php?location=cours">Cours</a> > <?=$lecours['titre']?></h2>
            <div class="cours">
                <h2><?=$lecours['titre']?></h2>
                <p class="description"><?=$lecours['description']?></p>
                <div class="info">
                    <p>Source : <a href="<?= $lecours['source']?>"><?= $lecours['source']?></a></p>
                    <p>Date de création : <?= $lecours['date_creation']?> </p>
                    <p>Dernière modification : <?= $lecours['date_modif']?></p>
                </div>
            </div>
        <?php endwhile; ?>

        <?php if(isset($lessons)): ?>
            <?php $i = 1; ?>
            <div class="allLessons">
                <?php while($lesson = $lessons->fetch()) : ?>
                    <div class="lesson">
                        <h3>Leçon <?php echo "$i : "; $i++; echo $lesson['titre']?></h3>
                        <div class="description">
                            <p><?=$lesson['description']?></p>
                        </div>
                        
                        <?php if($lesson['statut'] == 'active'): ?>
                            <!-- si connecté lien vers la leçon sinon page connection-->
                            <?php if(isset($_SESSION['connected'])): ?> 
                                <a href="<?= $lesson['fichier'] ?>">voir la leçon</a>
                            <?php else: ?>
                                <a href="index.php?location=login">voir la leçon</a>
                            <?php endif; ?>
                        
                        <?php else: ?>
                            cette leçon est momentanement indisponible
                        <?php endif; ?>
                
                        
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>