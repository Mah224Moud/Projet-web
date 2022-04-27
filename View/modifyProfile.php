<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/modify.css?ts=<?=time()?>">

    <title>Modifier</title>
</head>
<body>
    <?php if(isset($_SESSION['connected'])): ?>
        <h2><a href="index.php">Accueil</a> > <a href="index.php?location=profile"><?=$_SESSION['username']?></a> > Modifier</h2>
    <?php endif ?>
    <div id="profile">
        <div id="me">
            <img src="<?=$_SESSION['picture']?>" id="pic" alt="">
            <span><strong><em><?=$_SESSION['username']?></em></strong></span>
        </div>
        <h1>Modifier</h1>

            <?php if(isset($errors['picture_extension'])): ?>
                <p class="errors"><?=$errors['picture_extension']?></p>
            <?php endif ?>
            <?php if(isset($errors['picture_size'])): ?>
                <p class="errors"><?=$errors['picture_size']?></p>
            <?php endif ?>

        <form action="index.php?location=updated" method="post" url="/uplodader-picture" enctype="multipart/form-data">
            <div id="button">
                <button type="submit" id="save">Enregistrer</button>
            </div>
            <div class="modify">
                <h3>Nom</h3>
                <input type="text" name="firstName" id="" value="<?=$_SESSION['firstName']?>">
            </div>
            <div class="modify">
                <h3>Prénom</h3>
                <input type="text" name="lastName" id="" value="<?=$_SESSION['lastName']?>">
            </div>
            <div class="modify">
                <h3>Mot de passe</h3>
                <input type="password" name="password" id="">
            </div>
            <div class="modify">
               <h3>Photo</h3>
                <div class="file">
                    <label for="">Changer de photo <input type="file" name="picture" id="" onchange="essai(this)"></label>
                    <img src="#" alt="" id="picture">
                </div>
            </div>
        </form>
        
    </div>
    <?php if(isset($updated)): ?>
        <script>
            alert("<?=$updated?>");
            window.location.replace('index.php?location=profile');
        </script>
    <?php endif ?>
    <script>
        var image= document.getElementById("picture");

        var essai= function (e){
            const [picture] = e.files
            if(picture){
                image.src= URL.createObjectURL(picture)
            }
        }
    </script>
</body>
</html>