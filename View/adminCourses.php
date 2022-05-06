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
    <?php require('headerAdmin.php'); ?>

    <?php if(isset($_SESSION['connected'])) :?>
        <h2><em>Bonjour <?=$_SESSION['username']?></em></h2>
    <?php endif ?>

    <a id="addCours" href="index.php?location=addCours">Ajouter un cours</a>
    <h1>Liste des cours</h1>

        <?php if(isset($cours)): ?>
            <div class="allCours">
                <?php while($lecours = $cours->fetch()) : ?>
                    <div class="cours listedCourses">
                        <h2><?=$lecours['titre']?></h2>
                        <p class="description"><?=$lecours['description']?></p>
                        <div>
                            <div class="info">
                                <p>Source : <?php if($lecours['source']=='')echo "Aucune source pour ce cours"; ?>
                                    <a href="<?= $lecours['source']?>"><?= $lecours['source']?></a>
                                </p>
                                <p>Date de création : <?= $lecours['date_creation']?> </p>
                                <p>Dernière modification : <?= $lecours['date_modif']?></p>
                            </div>
                            <div class="buttons">
                                <a href="index.php?location=modifyCours&idCours=<?=$lecours['id']?>">modifier</a>
                                <?php if($lecours['statut'] == 'active'): ?>
                                    <a href="index.php?location=disableCours&idCours=<?=$lecours['id']?>">désactiver</a>
                                <?php else : ?>
                                    <a href="index.php?location=ableCours&idCours=<?=$lecours['id']?>">activer</a>
                                <?php endif; ?>
                                <a href="index.php?location=deleteCours&idCours=<?=$lecours['id']?>">supprimer</a>
                            </div>
                        </div>

                        <a href="index.php?location=adminLeCours&idCours=<?=$lecours['id']?>">Acceder au cours</a>
            
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($confirm)): ?>
            <script>alert("<?=$confirm?>");
                window.location.replace("index.php?location=adminCourses");
            </script>
        <?php endif ?>
</body>
</html>