<?php
session_start();
$pdo = require_once '../config/database.php';
require_once '../models/Achat.php';

$achatModel = new AchatModel($pdo);

print_r($_SESSION['achat']);
try {
    if (!isset($_SESSION['achat'])) {
        throw new Exception("Session invalide");
    }

    $achat = $_SESSION['achat'];
    $quantite = $achat['quantite'] ?? 1;

    // Récupération des données produit
    $trotinette = $achatModel->getTrottinette($achat['trottinette_id']);
    if (!$trotinette) throw new Exception("Trottinette non trouvée");
    if ($trotinette['Quantite'] < $quantite) throw new Exception("Stock insuffisant");

    $pdo->beginTransaction();

    // Gestion du client
    $clientData = [];
    $isNewClient = false;

    if (isset($_SESSION['client_id'])) {
        // Client existant
        $clientId = $_SESSION['client_id'];
        $clientFromDB = $achatModel->getClientById($clientId);
        
        if (!$clientFromDB) {
            throw new Exception("Client introuvable en base de données");
        }

        $clientData = [
            'id' => $clientId,
            'nom' => $clientFromDB['NomClient'],
            'adresse' => $clientFromDB['Adresse'],
            'telephone' => $clientFromDB['Telephone']
        ];

    } else {
        // Nouveau client
        if (!isset($achat['nom'], $achat['adresse'], $achat['telephone'])) {
            throw new Exception("Données client manquantes");
        }

        $clientId = $achatModel->createClient(
            $achat['nom'], 
            $achat['adresse'], 
            $achat['telephone']
        );

        $clientData = [
            'id' => $clientId,
            'nom' => $achat['nom'],
            'adresse' => $achat['adresse'],
            'telephone' => $achat['telephone']
        ];

        $isNewClient = true;
        $_SESSION['is_new_client'] = true; // Stockage en session
    }

    // Création de la commande
    $total = $trotinette['Tarif'] * $quantite;
    $commandeId = $achatModel->createCommande($clientId, $total);
    $achatModel->createLigneCommande($commandeId, $achat['trottinette_id'], $trotinette['Tarif']);
    $achatModel->updateStock($achat['trottinette_id'], $quantite);

    // Préparation des données pour la vue
    $_SESSION['invoice_data'] = [
        'commande' => [
            'id' => $commandeId,
            'date' => date('d/m/Y H:i'),
            'total' => $total
        ],
        'client' => $clientData,
        'produit' => [
            'id' => $trotinette['IDTrotinette'],
            'nom' => $trotinette['Libelle'],
            'prix' => $trotinette['Tarif'],
            'quantite' => $quantite
        ]
    ];

    $pdo->commit();
    unset($_SESSION['achat']);

    // Nettoyage session SI client créé (même après redirection)
    if ($isNewClient) {
        unset(
            $_SESSION['client_id'], 
            $_SESSION['client_data'],
            $_SESSION['is_new_client']
        );
         // Détachement de la session
    }

    header('Location: ../views/html/confirmationonly.php');
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    $_SESSION['error'] = "Erreur : " . $e->getMessage();
    header('Location: ../views/html/achete.php');
    exit;
}
?>
