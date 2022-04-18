<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/CSS/menu.css?ts=<?=time()?>">
    <link rel="stylesheet" href="Public/CSS/signupAndLogin.css?ts=<?=time()?>">
    <title>Ajout utilisateur</title>
</head>
<body>

    <?php if(isset($report)) :?>
        <script>
            alert("<?=$report?>");
            window.location.replace('index.php?location=signal');
        </script>
    <?php endif ?>
    
</body>
</html>