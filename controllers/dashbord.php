<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['client_id'])) {
    header('Location: ../../auth/login.php');
    exit;
}

require_once '../models/Client.php';
require_once '../models/ClientParticulier.php';
require_once '../models/ClientEntreprise.php';
$db = require_once '../config/database.php';



$client = Client::findByEmail($db, $_SESSION['client_email']);


if ($client) {
 
    $clientData = [
        'email' => $client->getEmail(),
        'nom' => $client->getNom(),
        'telephone' => $client->getTelephone(),
        'adresse' => $client->getAdresse()
    ];

   
    extract($clientData);  // Cette ligne rend chaque élément du tableau une variable

    
    require_once '../views/html/dashboardclient/dashbordCP.php';
} else {
    echo "Aucun client trouvé.";
}
?>
