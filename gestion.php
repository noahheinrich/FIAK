<?php
require_once('connexion.php');
?>

<script>
    //FONCTION QUI AFFICHE LE NOM DU FICHIER LORSQUE QU'IL EST CHARGE
    const fileImg = document.getElementById('img-file');
    fileImg.onchange = () => {
        if (fileImg.files.length == 1) {
            var selectedFiles = fileImg.files[0].name;
            document.getElementById("import-picture").innerHTML = selectedFiles;
        } else {
            document.getElementById("import-picture").innerHTML = "Importez 1 image maximum !";
        }
    }
</script>

<?php
// Vérifier si un fichier a été téléchargé
if (isset($_FILES['edit-image']) && !empty($_FILES['edit-image']['name'])) {

    // Récupérer les informations sur le fichier téléchargé
    $file = $_FILES['edit-image'];

    // Vérifier s'il y a des erreurs lors du téléchargement
    if ($file['error'] === 0) {

        // Récupérer le nom et le chemin temporaire du fichier
        $filename = $file['name'];
        $tempfile = $file['tmp_name'];

        // Déplacer le fichier téléchargé vers un dossier de destination
        $destination = 'img/products/' . $filename;
        move_uploaded_file($tempfile, $destination);

        // Stocker le chemin de l'image dans une base de données
        $image_path = $destination;
    }
}

if (isset($_POST['submit_add_product'])) {
    $nom = $_POST['nom'];
    $marque_id = $_POST['marque'];
    $categorie_id = $_POST['categorie'];

    // Insérer les données dans la table produit
    $sql = "INSERT INTO produits (nom, marques_id, categories_id, image_path) 
                VALUES ('$nom', '$marque_id', '$categorie_id', '$image_path')";

    $CONNEXION->query($sql);

    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<?php
if (isset($_POST['submit_add_brand'])) {
    $marque = $_POST['nom'];
    // si le nom existe déja dans la base de données on ne l'ajoute pas
    $request = "SELECT * FROM marques WHERE marque = '$marque'";
    $result = mysqli_query($CONNEXION, $request);
    if (mysqli_num_rows($result) > 0) {
        echo "La marque existe déjà";

    } else {
        $request = "INSERT INTO marques (marque) VALUES ('$marque')";
        $result = mysqli_query($CONNEXION, $request);
        if ($result) {
            echo "Marque ajoutée avec succès";


        } else {
            echo "Erreur lors de l'ajout de la marque";
        }
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>
<?php
if (isset($_POST['submit_edit_brand'])) {

    $id_marque = key($_POST['modifier_marque']);

    // Récupération du nouveau nom de la catégorie correspondante
    $nouveau_nom = $_POST['nouveau_nom'][$id_marque];

    // Vérification que le nouveau nom n'est pas une chaîne vide
    if (trim($nouveau_nom) == "") {
        echo "Le nouveau nom ne peut pas être vide";
    } else {
        // Exécution de la requête SQL pour modifier la catégorie
        $requete = "UPDATE marques SET marque = '$nouveau_nom' WHERE id = $id_marque";
        mysqli_query($CONNEXION, $requete);
    }
}

if (isset($_POST['supprimer_marque'])) {
    $id_marque = key($_POST['supprimer_marque']);

    // Vérification qu'il n'y a pas de produits associés à cette catégorie
    $requete = "SELECT COUNT(*) FROM produits WHERE marques_id = $id_marque";
    $resultat = mysqli_query($CONNEXION, $requete);
    $nombre_de_produits = mysqli_fetch_array($resultat)[0];
    if ($nombre_de_produits > 0) {
        echo "Impossible de supprimer la marque car des produits y sont associés";
    } else {
        // Exécution de la requête SQL pour supprimer la catégorie
        echo "Marque supprimée avec succès";
        $requete = "DELETE FROM marques WHERE id = $id_marque";
        mysqli_query($CONNEXION, $requete);
    }
}
?>

<?php
if (isset($_POST['edit_etat'])) {
    echo "Le formulaire a été soumis";
    $produit_id = $_POST['edit_etat'];
    $etat = $_POST['etat_stock'];
    $utilisateur_id = $_POST['user_id_edit'];
    //si l'etat du stock etait inutilisable et passe à autre chose et que le produit n'était pas réservé on met la dispo à 1
    if ($etat != 5 && $utilisateur_id == 1) {
        $sql = "UPDATE stocks SET dispo = 1 WHERE id = $produit_id";
        $CONNEXION->query($sql);
    }


    $sql = "UPDATE stocks SET etats_id = '$etat' WHERE id = $produit_id";
    if (mysqli_query($CONNEXION, $sql)) {
        $reussite = TRUE;
        echo "La mise à jour de l'état a réussi";
    } else {
        $reussite = FALSE;
        echo "La mise à jour de l'état a échoué : " . mysqli_error($CONNEXION);
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<?php

if (isset($_POST['submit_stock'])) {
    $product_id = $_POST['submit_stock'];
    $neuf = intval($_POST['neuf']);
    $bon = intval($_POST['bon']);
    $endommage = intval($_POST['endommage']);
    $mauvais = intval($_POST['mauvais']);
    $inutilisable = intval($_POST['inutilisable']);

    // Vérification des valeurs des inputs
    if ($neuf < 0 || $bon < 0 || $endommage < 0 || $mauvais < 0 || $inutilisable < 0) {
        echo "Les valeurs doivent être positives";
    } else {
        // Préparation de la requête SQL pour ajouter les stocks
        $sql = "INSERT INTO stocks (produits_id, etats_id, dispo, utilisateurs_id) VALUES ";
        $values = array();
        if ($neuf > 0) {
            for ($i = 0; $i < $neuf; $i++) {
                $values[] = "($product_id, 1, 1, 1)";
            }
        }
        if ($bon > 0) {
            for ($i = 0; $i < $bon; $i++) {
                $values[] = "($product_id, 2, 1, 1)";
            }
        }
        if ($endommage > 0) {
            for ($i = 0; $i < $endommage; $i++) {
                $values[] = "($product_id, 3, 1, 1)";
            }
        }
        if ($mauvais > 0) {
            for ($i = 0; $i < $mauvais; $i++) {
                $values[] = "($product_id, 4, 1, 1)";
            }
        }
        if ($inutilisable > 0) {
            for ($i = 0; $i < $inutilisable; $i++) {
                $values[] = "($product_id, 5, 0, 1)";
            }
        }
        $sql .= implode(",", $values);

        // Exécution de la requête SQL pour ajouter les stocks
        if ($CONNEXION->query($sql) === TRUE) {
            echo "Les stocks ont été ajoutés avec succès.";
        } else {
            echo "Erreur lors de l'ajout des stocks : " . $CONNEXION->error;
        }
    }
}

?>

<?php

if (isset($_POST['delete_stock'])) {
    $stock_id = $_POST['delete_stock'];
    $sql = "DELETE FROM stocks WHERE id = $stock_id";
    $CONNEXION->query($sql);
}


?>

<?php
if (isset($_POST["submit_edit_product"])) {
    $edit = $_POST["submit_edit_product"];
    $nom = $_POST["nom"];
    $marque = $_POST["marque"];

    $sql = "UPDATE produits SET ";
    $update_fields = array();
    if (!empty($nom)) {
        $update_fields[] = "nom='$nom'";
    }
    if (!empty($marque)) {
        $update_fields[] = "marques_id='$marque'";
    }
    if (count($update_fields) > 0) {
        $sql .= implode(", ", $update_fields) . " ";
        $sql .= "WHERE id='$edit'";
        if ($CONNEXION->query($sql) === TRUE) {
            $reussite = TRUE;
        } else {
            $reussite = FALSE;
        }
    }

    if (isset($_FILES['edit-image']) && !empty($_FILES['edit-image']['name'])) {
        $file = $_FILES['edit-image'];
        if ($file['error'] === 0) {
            $filename = $file['name'];
            $tempfile = $file['tmp_name'];
            $destination = 'img/products/' . $filename;
            move_uploaded_file($tempfile, $destination);
            $image_path = $destination;
            $sql = "UPDATE produits SET image_path='$image_path' WHERE id='$edit'";
            if ($CONNEXION->query($sql) !== TRUE) {
                $reussite = FALSE;
            }
        }
    } else {
        $sql = "SELECT image_path FROM produits WHERE id='$edit'";
        $result = mysqli_query($CONNEXION, $sql);
        $produit = mysqli_fetch_assoc($result);
        $image_path = $produit['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $sql = "UPDATE produits SET image_path=NULL WHERE id='$edit'";
        if ($CONNEXION->query($sql) !== TRUE) {
            $reussite = FALSE;
        }
    }

    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
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
    <link rel="stylesheet" href="css/pages/gestion.css" />
    <link rel="stylesheet" href="css/components/buttons.css" />
    <link rel="stylesheet" href="css/components/form.css" />
    <link rel="stylesheet" href="css/components/popup.css" />
    <link rel="stylesheet" href="fonts/fonts.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Gestion</title>
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
                <h1>Gestion Produit</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index.php">FIAK</a></li>
                        <li><a href="gestion.php">Gestion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="wrap">
            <div class="main1">

                <?php if (isset($_POST["add_product"])) : ?>
                    <?php
                    $edit = $_POST["add_product"];
                    $request = "SELECT * FROM produits";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    ?>

                    <div class="popup-modale2">
                        <div class="popup-modale-content2">
                            <h2>Ajouter un produit</h2>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="submit_add_product" value="<?php echo $edit; ?>">
                                <label>Nom du produit :</label><br>
                                <input type="text" id="name" name="nom" required><br>
                                <label>Marque :</label><br>
                                <select name="marque" required>
                                    <option value="" disabled selected hidden>Sélectionner une marque</option>
                                    <?php
                                    $marques = mysqli_query($CONNEXION, "SELECT * FROM marques");
                                    while ($marque = mysqli_fetch_assoc($marques)) {
                                        echo "<option value='" . $marque['id'] . "'>" . $marque['marque'] . "</option>";
                                    }
                                    ?>
                                </select><br>
                                <label>Catégorie :</label><br>
                                <select name="categorie" required>
                                    <option value="" disabled selected hidden>Sélectionner une catégorie</option>
                                    <?php
                                    $categories = mysqli_query($CONNEXION, "SELECT * FROM categories");
                                    while ($categorie = mysqli_fetch_assoc($categories)) {
                                        echo "<option value='" . $categorie['id'] . "'>" . $categorie['categorie'] . "</option>";
                                    }
                                    ?>
                                </select><br>
                                <div class="input-img">
                                    <div class="text-import">
                                        <label id="label-file" for="img-file">
                                            <div class="icon-upload"></div>
                                        </label>
                                        <span id="import-picture" class="import-picture"><label>Image : </label></span>
                                    </div>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                    <input id="img-file" type="file" name="edit-image" accept=".png" />
                                </div>
                                <input id="whitetext" class="add" type="submit" value="Ajouter">
                            </form>
                            <a class="close-btn" href="gestion.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_POST["add_brand"])) : ?>
                    <?php
                    $edit = $_POST["add_brand"];
                    $request = "SELECT * FROM marques";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    ?>

                    <div class="popup-modale2">
                        <div class="popup-modale-content2">
                            <h2>Ajouter une marque</h2>
                            <form method="POST">
                                <input type="hidden" name="submit_add_brand" value="<?php echo $edit; ?>">
                                <label>Nom de la marque :</label><br>
                                <input type="text" id="name" name="nom" required><br>
                                <input id="whitetext" class="add" type="submit" value="Ajouter">
                            </form>
                            <a class="close-btn" href="gestion.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_POST["edit_brand"])) : ?>
                    <?php
                    $edit = $_POST["edit_brand"];
                    $request = "SELECT * FROM marques";
                    $result = mysqli_query($CONNEXION, $request);
                    ?>

                    <div class="popup-modale2">
                        <div class="popup-modale-content2">
                            <h2>Modifier une marque</h2>
                            <?php
                            // Récupération des catégories depuis la base de données
                            $marques = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                $marques[] = $row;
                            }

                            // Affichage du tableau HTML
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Nom</th>';
                            echo '<th>Nouveau nom</th>';
                            echo '<th>Actions</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            foreach ($marques as $marque) {
                                echo '<tr>';
                                echo '<td>' . $marque['id'] . '</td>';
                                echo '<td>' . $marque['marque'] . '</td>';
                                echo '<td>';
                                echo '<form method="POST">';
                                echo '<input type="hidden" name="submit_edit_brand" value="' . $edit . '">';
                                echo '<input type="text" name="nouveau_nom[' . $marque['id'] . ']">';
                                echo '<button id="btnbrand" type="submit" name="modifier_marque[' . $marque['id'] . ']">Modifier</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '<td>';
                                echo '<form method="POST">';
                                echo '<input type="hidden" name="submit_delete_brand" value="' . $edit . '">';
                                echo '<button type="submit" name="supprimer_marque[' . $marque['id'] . ']">Supprimer</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';

                            ?>
                            <a class="close-btn" href="gestion.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="filters">
                    <form method="POST">
                        <button type="submit" id="ajouter-produit" name="add_product" aria-label="Ajouter un produit">Ajouter un produit</button>
                    </form>
                    <form method="POST">
                        <button type="submit" id="ajouter-brand" name="add_brand" aria-label="Ajouter une marque">Ajouter une marque</button>
                    </form>
                    <form method="POST">
                        <button type="submit" id="modifier-brand" name="edit_brand" aria-label="Modifier une marque">Modifier une marque</button>
                    </form>
                    <form method="GET">
                        <label>Categories:</label>
                        <select id="input-category" name="category" onchange="this.form.submit()">
                            <option value="all" <?php if (!isset($_GET['category']) || $_GET['category'] == 'all') {
                                                    echo 'selected';
                                                } ?>>Tous les produits</option>
                            <option value="1" <?php if (isset($_GET['category']) && $_GET['category'] == '1') {
                                                    echo 'selected';
                                                } ?>>Audio</option>
                            <option value="2" <?php if (isset($_GET['category']) && $_GET['category'] == '2') {
                                                    echo 'selected';
                                                } ?>>Informatique</option>
                            <option value="3" <?php if (isset($_GET['category']) && $_GET['category'] == '3') {
                                                    echo 'selected';
                                                } ?>>Photographie</option>
                            <option value="4" <?php if (isset($_GET['category']) && $_GET['category'] == '4') {
                                                    echo 'selected';
                                                } ?>>TV</option>
                            <option value="5" <?php if (isset($_GET['category']) && $_GET['category'] == '5') {
                                                    echo 'selected';
                                                } ?>>Smartphone</option>
                        </select>
                        <label>Trier par:</label>
                        <select id="input-sort" name="sort" onchange="this.form.submit()">
                            <option value="" <?php if (!isset($_GET['sort']) || $_GET['sort'] == '') {
                                                    echo 'selected';
                                                } ?>>-</option>
                            <option value="asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'asc') {
                                                    echo 'selected';
                                                } ?>>Stock (ASC)</option>
                            <option value="desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
                                                        echo 'selected';
                                                    } ?>>Stock (DESC)</option>
                        </select>
                    </form>
                </div>

            </div>
            <div class="main2">

                <?php if (isset($_POST["edit_product"])) : ?>
                    <?php
                    $edit = $_POST["edit_product"];
                    $request = "SELECT * FROM produits WHERE id = $edit";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    ?>

                    <div class="popup-modale">
                        <div class="popup-modale-content">
                            <h2>Modifier le produit</h2>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="submit_edit_product" value="<?php echo $edit; ?>">
                                <label for="nom">Modifier le nom:</label>
                                <input type="text" id="nom" name="nom">
                                <label for="marque">Modifier la marque:</label>
                                <?php
                                // ecrire le nom de la marque de ce produit :
                                $request = "SELECT * FROM marques WHERE id = " . $produit['marques_id'];
                                $result = mysqli_query($CONNEXION, $request);
                                $marque = mysqli_fetch_assoc($result);
                                echo "Nom de la marque actuelle : " . $marque['marque'];
                                ?>

                                <select id="marque" name="marque">
                                    <option value="" disabled selected>Choisir une marque</option>
                                    <?php
                                    $request = "SELECT * FROM marques";
                                    $result = mysqli_query($CONNEXION, $request);
                                    $marques = array();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $marques[] = $row;
                                    }
                                    foreach ($marques as $marque) {
                                        echo '<option value="' . $marque['id'] . '">' . $marque['marque'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <label for="image">Modifier l'image:</label>
                                <input type="file" id="image" name="edit-image" required>
                                <button type="submit">Enregistrer</button>
                            </form>
                            <a class="close-btn" href="gestion.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_POST["edit_stock"])) : ?>
                    <?php
                    $edit = $_POST["edit_stock"];
                    $request = "SELECT * FROM produits WHERE id = $edit";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    ?>

                    <div class="popup-modale">
                        <div class="popup-modale-content">
                            <h2>Ajouter du stock</h2>
                            <form method="post" enctype="multipart/form-data" id="edit_stock_form">
                                <input type="hidden" name="submit_stock" value="<?php echo $edit; ?>">
                                <label for="neuf">Ajouter du stock neuf:</label>
                                <input type="number" id="neuf" name="neuf">
                                <label for="bon">Ajouter du stock bon état</label>
                                <input type="number" id="bon" name="bon">
                                <label for="endommage">Ajouter du stock endommagé</label>
                                <input type="number" id="endommage" name="endommage">
                                <label for="mauvais">Ajouter du stock mauvais état</label>
                                <input type="number" id="mauvais" name="mauvais">
                                <label for="inutilisable">Ajouter du stock inutilisable</label>
                                <input type="number" id="inutilisable" name="inutilisable">
                                <button type="submit" id="enregistrer-btn" disabled>Enregistrer</button>
                                <script>
                                    const inputs = document.querySelectorAll('#edit_stock_form input[type="number"]');
                                    const enregistrerBtn = document.getElementById('enregistrer-btn');

                                    function checkInputs() {
                                        let hasValue = false;
                                        inputs.forEach(input => {
                                            if (input.value !== "") {
                                                hasValue = true;
                                            }
                                        });

                                        enregistrerBtn.disabled = !hasValue;
                                    }

                                    inputs.forEach(input => {
                                        input.addEventListener('input', checkInputs);
                                    });
                                </script>
                            </form>
                            <a class="close-btn" href="gestion.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_POST["del_stock"])) : ?>
                    <?php
                    $edit = $_POST["del_stock"];
                    $request = "SELECT * FROM stocks WHERE id = $edit";
                    $result = mysqli_query($CONNEXION, $request);
                    $produit = mysqli_fetch_assoc($result);
                    ?>

                    <div class="popup-modale2">
                        <div class="popup-modale-content2">
                            <?php
                            $product_id = $_POST['del_stock'];

                            // Récupération des informations sur le produit
                            $sql = "SELECT nom FROM produits WHERE id = $product_id";
                            $result = $CONNEXION->query($sql);
                            $row = $result->fetch_assoc();
                            $product_name = $row['nom'];

                            // Récupération des informations sur les stocks du produit
                            $sql = "SELECT s.id, s.dispo, e.etat AS etat, u.id AS utilisateurs_id, u.nom AS utilisateur_nom, s.produits_id 
                                    FROM stocks AS s 
                                    LEFT JOIN etats AS e ON s.etats_id = e.id 
                                    LEFT JOIN utilisateurs AS u ON s.utilisateurs_id = u.id 
                                    WHERE s.produits_id = $product_id
                                    ORDER BY s.etats_id ASC";
                            $result = $CONNEXION->query($sql);

                            // Affichage des informations sur les stocks du produit
                            echo '<h1>Stocks pour le produit : ' . $product_name . '</h1>';
                            echo '<table>';
                            echo '<tr><th>ID</th><th>Disponibilité</th><th>État</th><th>Changer l\'état</th><th>Utilisateur</th><th>Actions</th></tr>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['id'] . '</td>';
                                echo '<td>' . ($row['dispo'] ? 'Disponible' : 'Non disponible') . '</td>';
                                echo '<td>' . $row['etat'] . '</td>';
                                echo '<td>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="edit_etat" value="' . $row['id'] . '">
                                <input type="hidden" name="user_id_edit" value="' . $row['utilisateurs_id'] . '">
                                <select name="etat_stock">
                                    <option value="" disabled selected>Modifier l\'état</option>';
                                $sql_etats = "SELECT id, etat FROM etats";
                                $result_etats = $CONNEXION->query($sql_etats);
                                while ($etat = $result_etats->fetch_assoc()) {
                                    $selected = ($etat['id'] == $row['etats_id']) ? 'selected' : '';
                                    echo '<option value="' . $etat['id'] . '" ' . $selected . '>' . $etat['etat'] . '</option>';
                                }
                                echo '
                                </select>
                                <button id="submit_etat" type="submit">Enregistrer</button>
                            </form>
                        </td>';
                                echo '<td>' . $row['utilisateur_nom'] . '</td>';
                                echo '<td>
                                <form method="POST" style="display: inline-block;">
                                    <button class="delete-form" type="submit" name="delete_stock" aria-label="Supprimer ce stock" value="' . $row['id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce stock ?\')">Supprimer</button>
                                </form>
                            </td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                            ?>
                            <a class="close-btn" href="gestion.php">Fermer</a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $request = "SELECT p.*, COUNT(s.produits_id) AS stock_total FROM produits p LEFT JOIN stocks s ON p.id = s.produits_id";

                $category_filter = "";

                if (isset($_GET['category']) && $_GET['category'] != 'all') {
                    $category_filter = " WHERE p.categories_id = '" . mysqli_real_escape_string($CONNEXION, $_GET['category']) . "'";
                }

                $sort_order = "";

                if (isset($_GET['sort']) && $_GET['sort'] != '') {
                    $sort_order = " ORDER BY stock_total ";

                    if ($_GET['sort'] == 'asc') {
                        $sort_order .= "ASC";
                    } else {
                        $sort_order .= "DESC";
                    }
                }

                $request .= $category_filter . " GROUP BY p.id" . $sort_order;

                if ($produits = mysqli_query($CONNEXION, $request)) :
                    foreach ($produits as $produit) :
                        $produit_id = $produit['id'];
                        $quantite_neuf_request = "SELECT COUNT(*) AS stock_neuf FROM stocks WHERE produits_id = $produit_id AND etats_id = 1";
                        $quantite_neuf_result = mysqli_query($CONNEXION, $quantite_neuf_request);
                        $quantite_neuf = mysqli_fetch_assoc($quantite_neuf_result)['stock_neuf'];

                        $quantite_bon_request = "SELECT COUNT(*) AS stock_bon FROM stocks WHERE produits_id = $produit_id AND etats_id = 2";
                        $quantite_bon_result = mysqli_query($CONNEXION, $quantite_bon_request);
                        $quantite_bon = mysqli_fetch_assoc($quantite_bon_result)['stock_bon'];

                        $quantite_endommage_request = "SELECT COUNT(*) AS stock_endommage FROM stocks WHERE produits_id = $produit_id AND etats_id = 3";
                        $quantite_endommage_result = mysqli_query($CONNEXION, $quantite_endommage_request);
                        $quantite_endommage = mysqli_fetch_assoc($quantite_endommage_result)['stock_endommage'];

                        $quantite_mauvais_request = "SELECT COUNT(*) AS stock_mauvais FROM stocks WHERE produits_id = $produit_id AND etats_id = 4";
                        $quantite_mauvais_result = mysqli_query($CONNEXION, $quantite_mauvais_request);
                        $quantite_mauvais = mysqli_fetch_assoc($quantite_mauvais_result)['stock_mauvais'];

                        $quantite_innutilisable_request = "SELECT COUNT(*) AS stock_innutilisable FROM stocks WHERE produits_id = $produit_id AND etats_id = 5";
                        $quantite_innutilisable_result = mysqli_query($CONNEXION, $quantite_innutilisable_request);
                        $quantite_innutilisable = mysqli_fetch_assoc($quantite_innutilisable_result)['stock_innutilisable'];

                        $quantite_total_request = "SELECT COUNT(*) AS stock_total FROM stocks WHERE produits_id = $produit_id";
                        $quantite_total_result = mysqli_query($CONNEXION, $quantite_total_request);
                        $quantite_total = mysqli_fetch_assoc($quantite_total_result)['stock_total'];
                ?>
                        <div class="test">
                            <div class="product">
                                <div class="product-display">
                                    <img class="img-product" src="<?php echo $produit['image_path']; ?>" alt="<?php echo $produit['nom']; ?>">
                                </div>
                                <div class="product-details">
                                    <h5><?php echo 'Nom du produit : ' . $produit['nom']; ?></h5>
                                    <div class="product-quantity">
                                        <h5><?php echo 'Quantité totale : ' . $quantite_total; ?></h5>
                                    </div>
                                    <div class="product-quantity-neuf">
                                        <h5><?php echo 'Quantité en neuf : ' . $quantite_neuf; ?></h5>
                                    </div>
                                    <div class="product-quantity-bon">
                                        <h5><?php echo 'Quantité en bon état : ' . $quantite_bon; ?></h5>
                                    </div>
                                    <div class="product-quantity-endommage">
                                        <h5><?php echo 'Quantité en état endommagé : ' . $quantite_endommage; ?></h5>
                                    </div>
                                    <div class="product-quantity-mauvais">
                                        <h5><?php echo 'Quantité en mauvais état : ' . $quantite_mauvais; ?></h5>
                                    </div>
                                    <div class="product-quantity-innutilisable">
                                        <h5><?php echo 'Quantité en état innutilisable : ' . $quantite_innutilisable; ?></h5>
                                    </div>
                                    <form method="POST">
                                        <button class="add-form" type="submit" id="modifier-produit" name="edit_product" aria-label="Modifier un produit" value="<?php echo $produit['id']; ?>">Modifier Produit</button>
                                    </form>
                                </div>
                                <form method="post" class="add-form">
                                    <input type="hidden" name="del_stock" value="<?php echo $produit['id']; ?>">
                                    <button type="submit" aria-label="Apercevoir le stock">Aperçu Stock</button>
                                </form>
                                <form method="post" class="add-form">
                                    <input type="hidden" name="edit_stock" value="<?php echo $produit['id']; ?>">
                                    <button type="submit" aria-label="Modifierle stock">Modifier Stock</button>
                                </form>
                                <?php
                                $id = $produit['id'];
                                $sql2 = "SELECT COUNT(*) AS nb_produits FROM stocks WHERE produits_id=$id AND utilisateurs_id<>1";
                                $result2 = $CONNEXION->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                $nb_produits = $row2["nb_produits"];
                                if ($nb_produits == 0) {
                                    $disabled = "";
                                } else {
                                    $disabled = "disabled";
                                }
                                ?>
                                <div class="button-dispo">
                                    <div id="<?php echo $produit['id'] ?>" class="toggle <?php echo intval($produit['disponible']) == 1 ? 'active' : ''; ?>  <?php echo $disabled; ?>">
                                        <div class="toggle-button"></div>
                                    </div>
                                    <div class="toggle-text">Disponible</div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <script>
                const toggleButtons = document.querySelectorAll('.product .toggle');

                // pour chanque bouton on ajoute un écouteur d'événement click
                toggleButtons.forEach(button => {
                    button.addEventListener('click', () => {

                        if (!button.classList.contains('disabled')) {
                            // on ajoute la classe active au bouton
                            button.classList.toggle('active');
                            // on récupère le texte du bouton
                            const text = button.parentElement.querySelector('.toggle-text');

                            const id = button.id;

                            // on change le texte du bouton
                            if (button.classList.contains('active')) {
                                text.innerHTML = 'Disponible';
                                update_disponible(id, 1)
                            } else {
                                text.innerHTML = 'Indisponible';
                                update_disponible(id, 0)
                            }
                        }
                    });
                });

                function update_disponible(id, state) {
                    // requête sur la page updateDisponible.php pour mettre à jour la disponibilité du produit avec comme paramètre id = id disponible = state et affiche dans la console le code de retour
                    fetch('updateDisponible.php?id=' + id + '&disponible=' + state)
                        .then(response => response.text())
                        .then(data => console.log(data))
                        .catch(error => console.log(error));
                }
            </script>
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