<?php
require_once('connexion.php');
require_once('log.php');
logToFile("updateDisponible.php");

if(isset($_GET['disponible']) && isset($_GET['id'])){
    logToFile($_GET['disponible']);
    logToFile($_GET['id']);

    // requête à la bdd pour mettre à jour le produit, en fonction de l'id et de la disponibilité
    $request = "UPDATE produits SET disponible = ".$_GET['disponible']." WHERE id = ".$_GET['id'];
    mysqli_query($CONNEXION, $request);
}

?>