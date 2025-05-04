
<?php
session_start();
require_once '../models/Panier.php';
$db = require_once '../config/database.php';

if (!isset($_SESSION['client_id'])) {
    echo "Veuillez vous connecter pour ajouter des produits au panier.";
    exit;
}

$idClient = $_SESSION['client_id'];
$idTrotinette = $_GET['id'] ?? null;
$idPiece = $_GET['idp'] ?? null;

// Vérification que l'utilisateur a bien sélectionné un produit
if ($idTrotinette === null && $idPiece === null) {
    echo "Aucun produit sélectionné.";
    exit;
}

if ($idTrotinette !== null && $idPiece !== null) {
    echo "Veuillez choisir un seul produit à la fois.";
    exit;
}



// Création de l'objet Panier
if (isset($idTrotinette)) {
    $panier = new Panier($idClient, $idTrotinette, null, 1); // Quantité par défaut 1
} elseif (isset($idPiece)) {
    $panier = new Panier($idClient, null, $idPiece, 1); // Quantité par défaut 1
}

try {
    $panier->ajouterAuPanier($db);
    echo "Produit ajouté au panier avec succès !";
    header('Location: IndexPanierController.php');
    exit;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
