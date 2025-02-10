<?php
require_once('connexion.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/layout/reset.css" />
    <link rel="stylesheet" href="css/layout/general.css" />
    <link rel="stylesheet" href="css/layout/header.css" />
    <link rel="stylesheet" href="css/layout/footer.css" />
    <link rel="stylesheet" href="css/pages/index.css" />
    <link rel="stylesheet" href="css/components/buttons.css" />
    <link rel="stylesheet" href="css/components/form.css" />
    <link rel="stylesheet" href="fonts/fonts.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Home</title>
</head>

<body>
    <header>
        <nav>
            <div class="wrap">
                <h2><a href="index.php" aria-label="Menu Principal">FIAK</a></h2>
                <ul>
                    <li><a href="audio.php" aria-label="Audio">Audio</a></li>
                    <li><a href="smartphone.php" aria-label="Smartphone">Smartphone</a></li>
                    <li><a href="tv.php" aria-label="TV">TV</a></li>
                    <li><a href="photo.php" aria-label="Photographie">Photographie</a></li>
                    <li><a href="informatique.php" aria-label="Informatique">Informatique</a></li>
                </ul>
            </div>
        </nav>

        <div class="ariane">
            <div class="wrap">
                <h1>Home</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index.php">FIAK</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="wrap">
            <div class="categories">
                <a href="audio.php" aria-label="Audio">
                    <div class="image">
                        <img class="img-categories" src="img/products/audio_index.png" alt="Audio">
                    </div>
                    <h4>Audio</h4>
                </a>
                <a href="smartphone.php" aria-label="Smartphone">
                    <div class="image">
                        <img class="img-categories" src="img/products/smartphone_index.png" alt="Smartphone">
                    </div>
                    <h4>Smartphone</h4>
                </a>
                <a href="tv.php" aria-label="TV">
                    <div class="image">
                        <img class="img-categories" src="img/products/tv_index.png" alt="TV">
                    </div>
                    <h4>TV</h4>
                </a>
                <a href="photo.php" aria-label="Photographie">
                    <div class="image">
                        <img class="img-categories" src="img/products/photographie_index.png" alt="Photographie">
                    </div>
                    <h4>Photographie</h4>
                </a>
                <a href="informatique.php" aria-label="Informatique">
                    <div class="image">
                        <img class="img-categories" src="img/products/informatique_index.png" alt="Informatique">
                    </div>
                    <h4>Informatique</h4>
                </a>
            </div>
            <div class="gestion">
                <a href="inscription.php">
                    <div class="image">
                        <img class="img-categories" src="img/inscription.svg" alt="inscription">
                    </div>
                    <h4>Inscription</h4>
                </a>
                <a href="gestion.php">
                    <div class="image">
                        <img class="img-categories" src="img/edit.svg" alt="edit">
                    </div>
                    <h4>Gestion Produit</h4>
                </a>
                <a href="gestion_user.php">
                    <div class="image">
                        <img class="img-categories" src="img/user.svg" alt="user">
                    </div>
                    <h4>Gestion Utilisateur</h4>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="wrap">
                <p>@FIAK - All Rights Reserved</p>
                <ul>
                    <li><a href="https://www.facebook.com/" target="_blank"><img src="img/facebook.png" alt="facebook"></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank"><img src="img/instagram.png" alt="instagram"></a></li>
                    <li><a href="https://www.twitter.com/" target="_blank"><img src="img/twitter.png" alt="twitter"></a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>