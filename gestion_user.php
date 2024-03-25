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
    <link rel="stylesheet" href="css/pages/gestion_user.css" />
    <link rel="stylesheet" href="css/components/buttons.css" />
    <link rel="stylesheet" href="css/components/form.css" />
    <link rel="stylesheet" href="css/components/popup.css" />
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
                <h1>Gestion Utilisateur</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index.php">FIAK</a></li>
                        <li><a href="inscription.php">Gestion utilisateurs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="wrap">
            <?php
            // Vérification de la connexion
            if ($CONNEXION->connect_error) {
                die("Connection failed: " . $CONNEXION->connect_error);
            }

            // Vérification si un formulaire de suppression a été soumis
            if (isset($_POST["supprimer"])) {
                // Récupération de l'identifiant de l'utilisateur à supprimer
                $id = $_POST["supprimer"];

                // Suppression de l'utilisateur dans la table "utilisateurs"
                $sql = "DELETE FROM utilisateurs WHERE id='$id'";

                if ($CONNEXION->query($sql) === TRUE) {
                    echo "<p style='color: green;'>L'utilisateur a été supprimé avec succès.</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $CONNEXION->error;
                }
            }

            if (isset($_POST["voir"])) {
                //afficher une popup avec un tableau des différents stock de produits réservé par l'utilisateur
                $id = $_POST["voir"];
                $sql = "SELECT stocks.*, produits.nom AS nom_produit, etats.etat AS nom_etat 
            FROM stocks
            INNER JOIN produits ON stocks.produits_id = produits.id
            INNER JOIN etats ON stocks.etats_id = etats.id 
            WHERE stocks.utilisateurs_id='$id'";
                $result = $CONNEXION->query($sql);
                if ($result->num_rows > 0) {
                    $afficherpopup = true;
                } else {
                    $afficherpopup = false;
                }
                if ($afficherpopup) {
                    echo "<div class='popup-modale'>";
                    echo "<div class='popup-modale-content'>";
                    echo "<table>";
                    echo "<tr><th>Produit</th><th>Etat</th><th>Action</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nom_produit"] . "</td>";
                        echo "<td>" . $row["nom_etat"] . "</td>";
                        echo "<td><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        // envoyer l'id de l'utilisateur et l'id du produit pour rendre le produit
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<input type='hidden' name='utilisateur' value='" . $row["utilisateurs_id"] . "'>";
                        echo "<input type='hidden' name='rendre' value='" . $row["produits_id"] . "'>";
                        echo "<input type='submit' value='Rendre'>";
                        echo "</form></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<a href='gestion_user.php'>Retour</a>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p>Aucun stock trouvé.</p>";
                }
            }

            if (isset($_POST["rendre"])) {
                $id = $_POST["id"];
                $produit_id = $_POST["rendre"];
                $utilisateur = $_POST["utilisateur"];
                // rend le produit en changeant l'id de l'utilisateur dans la table stock par 1 et en changeant la dispo à 1
                $sql = "UPDATE stocks SET utilisateurs_id=1, dispo=1 WHERE produits_id='$produit_id' AND utilisateurs_id='$utilisateur' AND id='$id'";
                if ($CONNEXION->query($sql) === TRUE) {
                    echo "<p style='color: green;'>Le produit a été rendu avec succès.</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $CONNEXION->error;
                }
            }

            // Récupération de la liste des utilisateurs
            $sql = "SELECT * FROM utilisateurs WHERE id != 1";
            $result = $CONNEXION->query($sql);

            if ($result->num_rows > 0) {
                // Affichage du tableau des utilisateurs avec bouton de suppression
                echo "<table>";
                echo "<tr><th>Nom</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    echo "<tr>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>";
                    // si l'utilisateur n'a pas de produit réserver, le bouton voir est grisé
                    $sql2 = "SELECT COUNT(*) AS nb_produits FROM stocks WHERE utilisateurs_id='$id'";
                    $result2 = $CONNEXION->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $nb_produits = $row2["nb_produits"];
                    if ($nb_produits > 0) {
                        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        echo "<input type='hidden' name='voir' value='" . $id . "'>";
                        echo "<input type='submit' value='Voir'>";
                        echo "</form>";
                    } else {
                        echo "<button type='button' class='btnvoir' disabled>Voir</button>";
                    }

                    // Vérification si l'utilisateur a des produits liés à son ID dans la table "stocks"
                    if ($nb_produits > 0) {
                        // Affichage du bouton de suppression grisé
                        echo "<button type='button' class='btnsupprimer' disabled>Supprimer</button>";
                    } else {
                        // Affichage du bouton de suppression
                        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        echo "<input type='hidden' name='supprimer' value='" . $id . "'>";
                        echo "<input type='submit' value='Supprimer'>";
                        echo "</form>";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                //affiche le message d'erreur dans la popup popup-modale-error
                echo "<div class='popup-modale-error'>";
                echo "<div class='popup-modale-content-error'>";
                echo "<p>Aucun utilisateur trouvé pour cet utilisateur.</p>";
                echo "<a href='gestion_user.php'>Retour</a>";
                echo "</div>";
                echo "</div>";
            }

            ?>
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