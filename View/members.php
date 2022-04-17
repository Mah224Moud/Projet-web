<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/members.css?ts=<?=time()?>">
    <title>Membres</title>
</head>
<body>
    <?php require('headerAdmin.php'); ?>
    <?php if(isset($_SESSION['admin_username'])) :?>
        <h2><em>Bonjour <?=$_SESSION['admin_username']?></em></h2>
    <?php endif ?>
    <h1>Bienvenue sur la page de liste des membres</h1>
    <?php if(isset($members)):?>
        <?php while($data= $members->fetch()) :?>
            <?php if($data['username'] != "admin"): ?>
                <p>
                    <img src="<?=$data['picture']?>" alt=""> <strong><?=$data['firstName']?></strong> <?=$data['lastName']?> <em>membre depuis le <?=$data['date_']?></em> <a href=""><button>Supprimer</button></a>
                </p>
            <?php endif ?>
        <?php endwhile?>
    <?php endif ?>
</body>
</html>