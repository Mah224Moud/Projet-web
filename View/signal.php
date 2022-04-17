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
    <?php if(isset($signal)):?>
        <?php while($data= $signal->fetch()) :?>
            <?php if($data['username'] != "admin"): ?>
                <div class="message">
                    <strong><?=$data['firstName']?></strong> <?=$data['lastName']?> <em>envoyé le <?=$data['date_']?></em><br>
                    <?=$data['messages']?>  <a href=""><button><?=$data['status_']?></button></a>
                </div><br>
            <?php endif ?>
        <?php endwhile?>
    <?php endif ?>
</body>
</html>