<?php
session_start();
require_once '../models/Panier.php';
$db = require_once '../config/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['client_id'])) {
    echo "Veuillez vous connecter pour ajouter des produits au panier.";
    exit;
}

if (isset($_GET['id'])) {
    $idTrotinette = $_GET['id'];
    $idClient = $_SESSION['client_id']; // ID du client connecté

    try {
        // Créer une instance de la classe Panier
        $panier = new Panier($idClient, $idTrotinette);

        // Ajouter ou mettre à jour le produit dans le panier
        $panier->ajouterAuPanier($db);

        // Rediriger l'utilisateur vers la page du panier après l'ajout
        header('Location: IndexPanierController.php');
        exit;

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Aucun produit sélectionné.";
}
?>
