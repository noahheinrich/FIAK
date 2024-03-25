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
    <link rel="stylesheet" href="css/pages/inscription.css" />
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
                <h1>Inscription</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index.php">FIAK</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="wrap">
            <?php
            // Vérification si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupération du nom de l'utilisateur
                $nom = $_POST["nom"];

                // Validation du nom
                if (empty($nom)) {
                    echo "<p style='color: red;'>Veuillez entrer un nom.</p>";
                } else {
                    // Vérification de la connexion
                    if ($CONNEXION->connect_error) {
                        die("Connection failed: " . $CONNEXION->connect_error);
                    }

                    // Vérification si le nom d'utilisateur existe déjà
                    $sql = "SELECT * FROM utilisateurs WHERE nom='$nom'";
                    $result = $CONNEXION->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<p style='color: red;'>Ce nom d'utilisateur existe déjà.</p>";
                    } else {
                        // Insertion du nom dans la table "utilisateurs"
                        $sql = "INSERT INTO utilisateurs (nom) VALUES ('$nom')";

                        if ($CONNEXION->query($sql) === TRUE) {
                            echo "<p style='color: green;'>Inscription réussie !</p>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $CONNEXION->error;
                        }
                    }
                }
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label id="nomform" for="nom">Nom :</label>
                <input type="text" id="nom" name="nom">
                <br><br>
                <button type="submit"> S'inscrire </button>
            </form>
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