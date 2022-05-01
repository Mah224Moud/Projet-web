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
    <h2><a href="index.php?location=adminHome">Accueil</a> > Membres</h2>

    <?php if(isset($total)): ?>
        <h2 class="total">Il y'a <?=$total['total']?> membres</h2>
    <?php endif?>


    <?php if(isset($members)):?>
        <?php while($data= $members->fetch()) :?>
            <?php if($data['username'] != "admin"): ?>
                <p>
                    <img src="<?=$data['picture']?>" alt=""> <strong><?=$data['firstName']?></strong> <?=$data['lastName']?> <em>membre depuis le <?=$data['date_']?></em> <a href="index.php?location=memberDelete&idUser=<?=$data['id']?>"><button>Supprimer</button></a>
                </p>
            <?php endif ?>
        <?php endwhile?>
    <?php endif ?>


    <?php if(isset($confirm)): ?>
        <script>alert("<?=$confirm?>");
        window.location.replace("index.php?location=allMembers");
    </script>
    <?php endif ?>

    

</body>
</html>