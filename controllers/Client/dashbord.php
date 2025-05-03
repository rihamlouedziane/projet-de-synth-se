<?php
session_start();


if (!isset($_SESSION['client_id']) ) {
    header('Location: LoginController.php');
    exit;
}



require_once '../../models/Client.php';
require_once '../../models/ClientParticulier.php';
require_once '../../models/ClientEntreprise.php';
$db = require_once '../../config/database.php';



$client = Client::findByEmail($db, $_SESSION['client_email']);


if ($client) {
 
    $clientData = [
        'email' => $client->getEmail(),
        'nom' => $client->getNom(),
        'telephone' => $client->getTelephone(),
        'adresse' => $client->getAdresse()
    ];

   
    extract($clientData);  

    
    require_once '../../views/html/dashboardclient/dashbordCP.php';
} else {
    echo "Aucun client trouvé.";
}
?>
