<?php
session_start();
$pdo = require_once '../config/database.php';
require_once '../models/Achat.php';

// Initialisation du modèle
$achatModel = new AchatModel($pdo);

try {
    // Vérification si la session achat existe
    if (!isset($_SESSION['achat'])) {
        throw new Exception("Session invalide");
    }

    // Récupération des données de la session
    $achat = $_SESSION['achat'];
    $quantite = $achat['quantite'];

    // Vérification de l'existence de la trottinette
    $trotinette = $achatModel->getTrottinette($achat['trottinette_id']);
    if (!$trotinette) {
        throw new Exception("Trottinette non trouvée.");
    }

    // Vérification de la quantité disponible
    if ($trotinette['Quantite'] < $quantite) {
        throw new Exception("Stock insuffisant.");
    }

    $prix = $trotinette['Tarif'];
    $pdo->beginTransaction();

    // Vérification si le client est connecté
    if (isset($_SESSION['client_id'])) {
        $clientId = $_SESSION['client_id'];
    } else {
        // Création du client si non connecté
        if (!isset($achat['nom'], $achat['adresse'], $achat['telephone'])) {
            throw new Exception("Données client manquantes.");
        }
        $clientId = $achatModel->createClient($achat['nom'], $achat['adresse'], $achat['telephone']);
    }

    // Création de la commande
    $total = $prix * $quantite;
    $commandeId = $achatModel->createCommande($clientId, $total);

    // Insertion de la ligne de commande
    $achatModel->createLigneCommande($commandeId, $achat['trottinette_id'], $prix);

    // Mise à jour du stock
    $achatModel->updateStock($achat['trottinette_id'], $quantite);

    // Commit de la transaction
    $pdo->commit();
    unset($_SESSION['achat']); // Suppression des données de session

    // Redirection vers la page de confirmation
    header('Location: ../views/html/confirmationonly.php');
    exit;
} catch (Exception $e) {
    // En cas d'erreur, rollback de la transaction
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['error'] = "Erreur : " . $e->getMessage();
    header('Location: ../views/html/achete.php');
    exit;
}
?>
