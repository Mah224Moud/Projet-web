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
    <?php require('headerAdmin.php'); ?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php else :?>
        <h2><em>Vous n'êtes pas connecté</em></h2>
    <?php endif ?>

    <?php if(isset($leCours)): ?>
        <?php while($lecours = $leCours->fetch()) : ?>
            <?php $idcours = $lecours['id']; ?>
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

        <a id="addCours" href="index.php?location=addLesson&idCours=<?=$idcours?>">Ajouter une leçon</a>

        <?php if(isset($lessons)): ?>
            <?php $i = 1; ?>
            <div class="allLessons">
                <?php while($lesson = $lessons->fetch()) : ?>
                    <div class="lesson">
                        <h3>Leçon <?php echo "$i : "; $i++; echo $lesson['titre']?></h3>
                        <div class="description">
                            <p><?=$lesson['description']?></p>
                        </div>
                        <div class="buttons">
                            <a href="index.php?location=modifyLesson&idCours=<?=$idcours?>&idLesson=<?=$lesson['id']?>">modifier</a>
                            <?php if($lesson['statut'] == 'active'): ?>
                                <a href="index.php?location=disableLesson&idCours=<?=$idcours?>&idLesson=<?=$lesson['id']?>">désactiver</a>
                            <?php else : ?>
                                <a href="index.php?location=ableLesson&idCours=<?=$idcours?>&idLesson=<?=$lesson['id']?>">activer</a>
                            <?php endif; ?>
                            <a href="index.php?location=removeLesson&idCours=<?=$idcours?>&idLesson=<?=$lesson['id']?>">supprimer</a>
                        </div>
                        
                        <?php if($lesson['fichier'] != ''): ?>
                            <a href="<?= $lesson['fichier'] ?>">voir la leçon</a>
                        <?php else: ?>
                            Aucun fichier pour cette leçon
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            
        <?php endif; ?>
    <?php endif; ?>


    <?php if(isset($confirm)): ?>
            <script>alert("<?=$confirm?>");
                window.location.replace("index.php?location=adminCourses");
            </script>
    <?php endif ?>

</body>
</html>