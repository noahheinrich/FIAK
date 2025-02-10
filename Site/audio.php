<?php
require_once('connexion.php');
?>

<?php
if (isset($_POST["reserve"]) && isset($_POST["utilisateur_id"])) {

    $produitId = $_POST["reserve"];
    $utilisateurId = $_POST["utilisateur_id"];
    $etatId = $_POST['etat'];

    // Vérifier la disponibilité du produit dans l'état sélectionné
    $requeteDisponibilite = "SELECT id FROM stocks WHERE produits_id = $produitId AND dispo > 0 AND etats_id = $etatId LIMIT 1";
    $resultatDisponibilite = mysqli_query($CONNEXION, $requeteDisponibilite);

    if (mysqli_num_rows($resultatDisponibilite) > 0) {
        // Vérifier si le produit est en stock
        $request = "SELECT * FROM stocks WHERE produits_id = $produitId AND dispo > 0 AND etats_id != 5";
        $result = mysqli_query($CONNEXION, $request);
        if (mysqli_num_rows($result) > 0) {
            // Réserver le produit
            $requeteReservation = "UPDATE stocks SET utilisateurs_id = $utilisateurId, dispo = dispo - 1 WHERE produits_id = $produitId AND etats_id = $etatId AND dispo > 0 LIMIT 1";
            if (mysqli_query($CONNEXION, $requeteReservation) === TRUE) {
                echo "La réservation a été effectuée avec succès.";
                // Mettre à jour le stock disponible pour le produit réservé
                $requeteMiseAJour = "UPDATE produits p SET p.stock_disponible = (
                                        SELECT SUM(s.dispo) 
                                        FROM stocks s 
                                        WHERE s.produits_id = $produitId
                                    ) WHERE p.id = $produitId";
                if (mysqli_query($CONNEXION, $requeteMiseAJour) === TRUE) {
                    echo "La mise à jour a été effectuée avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour du stock: " . mysqli_error($CONNEXION);
                }
            } else {
                echo "Erreur lors de la réservation: " . mysqli_error($CONNEXION);
            }
        } else {
            echo "Ce produit n'est pas disponible.";
        }
    } else {
        echo "Ce produit n'est pas disponible dans l'état sélectionné.";
    }
    header("Location: audio.php");
    exit();
}
?>
<?php
if (isset($_POST['rendre']) && isset($_POST['utilisateur_id'])) {
    $utilisateurId = $_POST['utilisateur_id'];
    $etatId = $_POST['etat'];
    $produitId = $_POST['rendre'];
    // Vérifier si le produit est réservé par l'utilisateur si oui, le rendre si non afficher un message d'erreur
    $requeteReservation = "SELECT * FROM stocks WHERE produits_id = $produitId AND utilisateurs_id = $utilisateurId AND etats_id = $etatId AND dispo < 1 LIMIT 1";
    $resultatReservation = mysqli_query($CONNEXION, $requeteReservation);
    if (mysqli_num_rows($resultatReservation) > 0) {
        // Rendre le produit
        $requeteRendre = "UPDATE stocks SET utilisateurs_id = 1, dispo = dispo + 1 WHERE produits_id = $produitId AND etats_id = $etatId AND dispo < 1 LIMIT 1";
        if (mysqli_query($CONNEXION, $requeteRendre) === TRUE) {
            echo "Le produit a été rendu avec succès.";
            // Mettre à jour le stock disponible pour le produit rendu
            $requeteMiseAJour = "UPDATE produits p SET p.stock_disponible = (
                                    SELECT SUM(s.dispo) 
                                    FROM stocks s 
                                    WHERE s.produits_id = $produitId
                                ) WHERE p.id = $produitId";
            if (mysqli_query($CONNEXION, $requeteMiseAJour) === TRUE) {
                echo "La mise à jour a été effectuée avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du stock: " . mysqli_error($CONNEXION);
            }
        } else {
            echo "Erreur lors de la réservation: " . mysqli_error($CONNEXION);
        }
    } else {
        //afficher le message d'erreur en alerte javascript
        echo "<script>alert('Ce produit n\'est pas réservé par vous.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/layout/reset.css" />
    <link rel="stylesheet" href="css/layout/general.css" />
    <link rel="stylesheet" href="css/layout/header.css" />
    <link rel="stylesheet" href="css/layout/footer.css" />
    <link rel="stylesheet" href="css/pages/products.css" />
    <link rel="stylesheet" href="css/components/buttons.css" />
    <link rel="stylesheet" href="css/components/form.css" />
    <link rel="stylesheet" href="fonts/fonts.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Audio</title>
</head>

<body>
    <header>
        <nav aria-label="Menu principal">
            <div class="wrap">
                <h2><a href="index.php" aria-label="Menu Principal">FIAK</a></h2>
                <ul>
                    <li><a href="audio.php" aria-label="Lien vers la page Audio">Audio</a></li>
                    <li><a href="smartphone.php" aria-label="Lien vers la page Smartphone">Smartphone</a></li>
                    <li><a href="tv.php" aria-label="Lien vers la page TV">TV</a></li>
                    <li><a href="photo.php" aria-label="Lien vers la page Photographie">Photographie</a></li>
                    <li><a href="informatique.php" aria-label="Lien vers la page Informatique">Informatique</a></li>
                </ul>
            </div>
        </nav>

        <div class="ariane" aria-label="Fil d'Ariane">
            <div class="wrap">
                <h1>Audio</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index.php">FIAK</a></li>
                        <li><a href="audio.php">Audio</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="wrap">
            <div class="main1">
                <div class="filters">
                    <h4>Résultats des produits de la catégorie Audio</h4>
                    <form method="GET">
                        <label>Trier par:</label>
                        <select id="input-sortby" name="sortby" onchange="this.form.submit()" aria-label="Sélectionner un critère de tri">
                            <option value="bestmatch" <?php if (!isset($_GET['sortby']) || $_GET['sortby'] == 'bestmatch') {
                                                            echo 'selected';
                                                        } ?>>Plus récent</option>
                            <option value="a-z" <?php if (isset($_GET['sortby']) && $_GET['sortby'] == 'a-z') {
                                                    echo 'selected';
                                                } ?>>A-Z</option>
                            <option value="z-a" <?php if (isset($_GET['sortby']) && $_GET['sortby'] == 'z-a') {
                                                    echo 'selected';
                                                } ?>>Z-A</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="main2">

                <?php
                if (isset($_POST["rendre"])) {
                    $produitId = $_POST["rendre"];
                    $request = "SELECT * FROM produits WHERE id = $produitId";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    $afficherPopupRendre = true;
                } else {
                    $afficherPopupRendre = false;
                }
                ?>

                <?php if ($afficherPopupRendre) : ?>
                    <div class="popup-modale">
                        <div class="popup-modale-content">
                            <h2>Rendre un produit</h2>
                            <form method="POST">
                                <input type="hidden" name="rendre" value="<?php echo $produit['id']; ?>">
                                <label for="utilisateur">Utilisateur :</label>
                                <select id="utilisateur" name="utilisateur_id" required>
                                    <option value="" disabled selected hidden>Choisir un utilisateur</option>
                                    <?php
                                    // ne pas afficher l'utilisateur avec l'id 1 (utilisateur par défaut)
                                    $request = "SELECT * FROM utilisateurs WHERE id != 1";
                                    $result = mysqli_query($CONNEXION, $request);
                                    while ($utilisateur = mysqli_fetch_assoc($result)) :
                                    ?>
                                        <option value="<?php echo $utilisateur['id']; ?>"><?php echo $utilisateur['nom']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <label for="etat">Etat :</label>
                                <select id="etat" name="etat" required>
                                    <option value="" disabled selected hidden>Choisir un état</option>
                                    <?php
                                    // ne pas afficher l'état Inutilisable
                                    $request = "SELECT * FROM etats WHERE id != 5";
                                    $result = mysqli_query($CONNEXION, $request);
                                    while ($etat = mysqli_fetch_assoc($result)) :
                                    ?>
                                        <option value="<?php echo $etat['id']; ?>"><?php echo $etat['etat']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <button type="submit" id="reservationBtn" name="submit" value="Rendre"> Rendre </button>
                                <script>
                                    // Vérifier si un utilisateur et un état ont été sélectionnés avant d'activer le bouton de réservation
                                    function checkReservationValidity() {
                                        var selectedUserId = document.getElementById('utilisateur').value;
                                        var selectedEtatId = document.getElementById('etat').value;
                                        var reservationBtn = document.getElementById('reservationBtn');

                                        if (selectedUserId !== '' && selectedEtatId !== '') {
                                            reservationBtn.disabled = false;
                                            reservationBtn.style.cursor = 'pointer';
                                        } else {
                                            reservationBtn.disabled = true;
                                            reservationBtn.style.cursor = 'not-allowed';
                                        }
                                    }

                                    checkReservationValidity();

                                    // Vérifier si un utilisateur a été sélectionné avant d'activer le bouton de réservation
                                    document.getElementById('utilisateur').addEventListener('change', checkReservationValidity);

                                    // Vérifier si un état a été sélectionné avant d'activer le bouton de réservation
                                    document.getElementById('etat').addEventListener('change', checkReservationValidity);
                                </script>
                            </form>
                            <a class="close-btn" href="audio.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                if (isset($_POST["reserve"])) {
                    $produitId = $_POST["reserve"];
                    $request = "SELECT * FROM produits WHERE id = $produitId";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    $afficherPopup = true;
                } else {
                    $afficherPopup = false;
                }
                ?>

                <?php if ($afficherPopup) : ?>
                    <div class="popup-modale">
                        <div class="popup-modale-content">
                            <h2>Réserver un produit</h2>
                            <form method="POST">
                                <input type="hidden" name="reserve" value="<?php echo $produit['id']; ?>">
                                <label for="utilisateur">Utilisateur :</label>
                                <select id="utilisateur" name="utilisateur_id" required>
                                    <option value="" disabled selected hidden>Sélectionner un utilisateur</option>
                                    <?php
                                    $query = "SELECT id, nom FROM utilisateurs WHERE nom != 'None'";
                                    $result = mysqli_query($CONNEXION, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $utilisateurId = $row['id'];
                                        $utilisateurNom = $row['nom'];
                                        // Générer l'option avec la valeur et le nom de l'utilisateur
                                        echo "<option value='$utilisateurId' $disabled>$utilisateurNom</option>";
                                    }
                                    ?>
                                </select>
                                <label for="etat">État :</label>
                                <select id="etat" name="etat" required>
                                    <option value="" disabled selected hidden>Sélectionner un état</option>
                                    <?php
                                    $query = "SELECT e.id, e.etat FROM etats e JOIN stocks s ON e.id = s.etats_id WHERE s.produits_id = $produitId AND s.dispo > 0 AND e.id != 5";
                                    $result = mysqli_query($CONNEXION, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $etatId = $row['id'];
                                        $etatNom = $row['etat'];

                                        // Générer l'option avec la valeur et le nom de l'état
                                        echo "<option value='$etatId'>$etatNom</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" id="reservationBtn" disabled>Réserver</button>
                                <script>
                                    // Vérifier si un utilisateur et un état ont été sélectionnés avant d'activer le bouton de réservation
                                    function checkReservationValidity() {
                                        var selectedUserId = document.getElementById('utilisateur').value;
                                        var selectedEtatId = document.getElementById('etat').value;
                                        var reservationBtn = document.getElementById('reservationBtn');

                                        if (selectedUserId !== '' && selectedEtatId !== '') {
                                            reservationBtn.disabled = false;
                                            reservationBtn.style.cursor = 'pointer';
                                        } else {
                                            reservationBtn.disabled = true;
                                            reservationBtn.style.cursor = 'not-allowed';
                                        }
                                    }

                                    checkReservationValidity();

                                    // Vérifier si un utilisateur a été sélectionné avant d'activer le bouton de réservation
                                    document.getElementById('utilisateur').addEventListener('change', checkReservationValidity);

                                    // Vérifier si un état a été sélectionné avant d'activer le bouton de réservation
                                    document.getElementById('etat').addEventListener('change', checkReservationValidity);
                                </script>

                            </form>
                            <a class="close-btn" href="audio.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $request = "SELECT * FROM produits WHERE categories_id = 1 AND disponible = 1";
                $sort_order = "";

                if (isset($_GET['sortby'])) {
                    switch ($_GET['sortby']) {
                        case "a-z":
                            $sort_order = "ORDER BY nom ASC";
                            break;
                        case "z-a":
                            $sort_order = "ORDER BY nom DESC";
                            break;
                        default:
                            $sort_order = "";
                    }
                }

                $request .= " " . $sort_order;



                if ($produits = mysqli_query($CONNEXION, $request)) :
                    foreach ($produits as $produit) :
                        $produit_id = $produit['id'];
                        $nomProduit = $produit['nom'];

                        // Nouvelle requête pour obtenir la quantité disponible
                        $quantite_disponible_request = "SELECT SUM(stocks.dispo) AS stock_disponible FROM stocks WHERE produits_id = $produit_id AND etats_id != 5";
                        $quantite_disponible_result = mysqli_query($CONNEXION, $quantite_disponible_request);
                        $quantite_disponible = mysqli_fetch_assoc($quantite_disponible_result)['stock_disponible'];
                ?>
                        <div>
                            <div class="product">
                                <div class="product-display">
                                    <img class="img-product" src="<?php echo $produit['image_path']; ?>" alt="<?php echo $produit['nom']; ?>">
                                </div>
                                <div class="product-details">
                                    <a href="">
                                        <h5><?php echo $nomProduit; ?></h5>
                                    </a>
                                </div>
                            </div>
                            <!-- <form method="GET"> -->
                            <input type="hidden" name="produit_id" value="<?php echo $produit_id; ?>">
                            <input type="hidden" name="qte" value="<?php echo $quantite_disponible ?>">
                            <div class="reserve">
                                <div class="product-quantity">
                                    <p aria-label="Quantité de produit restante"><?php echo 'Restant : ' . $quantite_disponible; ?></p>
                                </div>
                                <?php
                                // Obtenir les états disponibles pour le produit
                                $requestEtats = "SELECT DISTINCT e.etat AS nom
                                                                    FROM stocks s 
                                                                    INNER JOIN etats e ON s.etats_id = e.id 
                                                                    WHERE s.produits_id = $produit_id
                                                                    AND e.id != 5
                                                                    AND s.dispo > 0";
                                $resultEtats = mysqli_query($CONNEXION, $requestEtats);
                                if (mysqli_num_rows($resultEtats) > 0) {
                                    $etats_disponibles = "";
                                    while ($rowEtats = mysqli_fetch_assoc($resultEtats)) {
                                        $etats_disponibles .= $rowEtats['nom'] . ",";
                                    }
                                    $etats_disponibles = rtrim($etats_disponibles, ",");
                                    echo "<p>États disponibles : ";
                                    $etats = explode(',', $etats_disponibles);
                                    foreach ($etats as $etat) {
                                        echo "<span>$etat</span>, ";
                                    }
                                    echo "</p>";
                                }
                                ?>
                                <form method="POST">
                                    <input type="hidden" name="reserve" value="<?php echo $produit['id']; ?>">
                                    <?php
                                    $sql = "SELECT COUNT(*) AS nb_stocks FROM stocks WHERE produits_id='" . mysqli_real_escape_string($CONNEXION, $produit['id']) . "' AND dispo=1 AND etats_id!=5";
                                    $result = $CONNEXION->query($sql);
                                    $row = $result->fetch_assoc();
                                    $nb_stocks = $row["nb_stocks"];
                                    if ($nb_stocks > 0) {
                                        echo "<button class='add-form' type='submit' id='reserver-produit' aria-label='Réserver un produit'>Réserver</button>";
                                    } else {
                                        echo "<button class='add-form' type='button' id='reserver-produit' aria-label='Réserver un produit' style='background-color: lightgrey; color: grey; cursor: not-allowed;' disabled>Réserver</button>";
                                    }
                                    ?>
                                </form>
                                <form method="POST">
                                    <input type="hidden" name="rendre" value="<?php echo $produit['id']; ?>">
                                    <?php
                                    //si il n'y a aucun produit qui à été réserver (toute la colonne utilisateurs_id dans stocks = 1) le bouton est gris et pas cliquable
                                    $sql = "SELECT COUNT(*) AS nb_stocks FROM stocks WHERE produits_id='" . mysqli_real_escape_string($CONNEXION, $produit['id']) . "' AND dispo=0 AND etats_id != 5";
                                    $result = $CONNEXION->query($sql);
                                    $row = $result->fetch_assoc();
                                    $nb_stocks = $row["nb_stocks"];
                                    if ($nb_stocks > 0) {
                                        echo "<button class='add-form' type='submit' id='rendre-produit' aria-label='Rendre un produit'>Rendre</button>";
                                    } else {
                                        echo "<button class='add-form' type='button' id='rendre-produit' aria-label='Rendre un produit' style='background-color: lightgrey; color: grey; cursor: not-allowed;' disabled>Rendre</button>";
                                    }
                                    ?>
                                </form>
                            </div>
                            <!-- </form> -->
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="wrap">
                <p>@FIAK - All Rights Reserved</p>
                <ul>
                    <li><a href="https://www.facebook.com/" target="_blank"><img src="img/facebook.png" alt="facebook" aria-label="Icône Facebook"></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank"><img src="img/instagram.png" alt="instagram" aria-label="Icône Instagram"></a></li>
                    <li><a href="https://www.twitter.com/" target="_blank"><img src="img/twitter.png" alt="twitter" aria-label="Icône Twitter"></a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>