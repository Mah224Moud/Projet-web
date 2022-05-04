<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/profile.css?ts=<?=time()?>">

    <title>Profile</title>
</head>
<body>
    <?php if(isset($member)): ?>
        <h2><a href="index.php">Accueil</a> > <a href="index.php?location=forum">Forum</a> ><?=$member['username']?></h2>
        <h1>Profile de <?=$member['username']?></h1>
        <div id="profile">
            <div id="me">
                <img src="<?=$member['picture']?>" alt="">
            </div>
            <div id="about">
                <h1>A propos</h1>
                <p><?=strtoupper($member['firstName'])?> <?=$member['lastName']?></p>
                <p>Né(e) le: <em><?=$member['birthday_']?></em></p>
                <p>Email: <em><?=$member['email']?></em></p>
                <p>Inscrit le: <em><?=$member['date_']?></em></p>
            </div>
        </div>
    <?php else:?>
        <script>
            alert('Something went wrong :(');
        </script>
    <?php endif?>
</body>
</html>