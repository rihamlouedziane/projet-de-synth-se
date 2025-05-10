<?php
session_start();

// Vérification de base de l'ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: sell.php');
    exit;
}

$trottinetteId = (int)$_GET['id'];
print_r($_SESSION['client_id']);
// Vérification améliorée de la session
if (isset($_SESSION['client_id'])) {
    // Stockage sécurisé dans la session
    $_SESSION['achat'] = [
        'trottinette_id' => $trottinetteId,
        'quantite' => 1 // Devrait venir d'un formulaire
    ];
    
    header('Location: CmdTrotionlyController.php');
    exit;
} else {
    // Stockage temporaire de l'ID pour le formulaire
    $_SESSION['achat_temp'] = $trottinetteId;
    header('Location: ../views/html/achete.php');
    exit;
}
?>