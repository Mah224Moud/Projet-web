<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signal.css?ts=<?=time()?>">
    <title>Signal</title>
</head>
<body>
    <?php require('headerAdmin.php'); ?>
    <?php if(isset($_SESSION['admin_username'])) :?>
        <h2><em>Bonjour <?=$_SESSION['admin_username']?></em></h2>
    <?php endif ?>
    <h1>Bienvenue sur la page des messages de contact</h1>
    <h2><a href="index.php?location=adminHome">Accueil</a> > Messages contact</h2>

    <?php if(isset($total)): ?>
        <h2 class="total">Il y'a <?=$total['total']?> messages</h2>
    <?php endif?>

    <?php if(isset($signal)):?>
        <?php while($data= $signal->fetch()) :?>
            <div class="message">
                <strong><?=$data['firstName']?></strong> <?=$data['lastName']?> <em>envoyé le <?=$data['date_']?></em><br>
                <?=$data['messages']?>

                <?php if($data['status_'] == "not_verified"): ?>
                    <a href="index.php?location=signalUpate&idSignal=<?=$data['id']?>"><button class="not-verified"><?=$data['status_']?></button></a>
                <?php else: ?>
                    <button class="verified"><?=$data['status_']?></button>
                <?php endif?>



                <?php if(!in_array($data['email'], $emails)) :?>
                    <a href="index.php?location=addUser&firstName=<?=$data['firstName']?>&lastName=<?=$data['lastName']?>&email=<?=$data['email']?>&username=<?=$data['username']?>"><button>Ajouter</button></a>
                <?php endif ?>
                <a href="index.php?location=messageDelete&idMessage=<?=$data['id']?>"><button>Supprimer</button></a>
            </div><br>
        <?php endwhile?>
    <?php endif ?>


    <?php if(isset($confirm)): ?>
        <script>alert("<?=$confirm?>");
        window.location.replace("index.php?location=signal");
    </script>
    <?php endif ?>

    <?php if(isset($deleteMessage)): ?>
        <script>alert("<?=$deleteMessage?>");
        window.location.replace("index.php?location=signal");
    </script>
    <?php endif ?>
</body>
</html>