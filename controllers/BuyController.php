<?php
session_start();

// Vérification de l'ID de la trottinette
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    $_SESSION['error'] = "Identifiant de produit invalide";
    header('Location: sell.php');
    exit;
}

$trottinetteId = (int)$_GET['id'];

// Vérification de l'existence du produit en base
require_once "../Models/Achat.php";
$db = require_once "../config/database.php";

$achatModel = new AchatModel($db);
$trottinette = $achatModel->getTrottinette($trottinetteId);

if (!$trottinette) {
    $_SESSION['error'] = "Produit introuvable";
    header('Location: sell.php');
    exit;
}

// Gestion de la session utilisateur
if (isset($_SESSION['client_id'])) {
    // Utilisateur connecté - Stockage complet en session
    $_SESSION['achat'] = [
        'client_id' => $_SESSION['client_id'],
        'produit' => [
            'id' => $trottinetteId,
            'nom' => $trottinette['Libelle'],
            'prix' => $trottinette['Tarif']
        ],
         'trottinette_id' => $trottinetteId,
        'quantite' => $_POST['quantite'] ?? 1 // À adapter selon formulaire
    ];
    
    header('Location: CmdTrotionlyController.php');
    exit;
} else {
    // Utilisateur non connecté - Stockage temporaire
    $_SESSION['achat_temp'] = [
        'trottinette_id' => $trottinetteId,
        'redirect' => 'CmdTrotionlyController.php'
    ];
    
    header('Location: ../views/html/achete.php?id=' . $trottinetteId);
    exit;
}
?>