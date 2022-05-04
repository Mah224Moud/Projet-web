<div class="menu">
    <ul>
        <li>
            <a href="index.php?location=homePage">Accueil</a>
        </li>
        <li>
            <a href="index.php?location=cours">Cours</a>
        </li>
        <li>
            <a href="index.php?location=forum">Forum</a>
        </li>
        <?php if(isset($_SESSION['connected'])) : ?>
            <li class="picture">
                <a href="index.php?location=profile">
                    <img src="<?=$_SESSION['picture']?>" alt="">
                    <div id="green_light"></div>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="index.php?location=login">Connexion</a>
            </li>
        <?php endif?>
    </ul>
</div>