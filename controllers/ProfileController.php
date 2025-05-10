<?php
session_start();

if (!isset($_SESSION['client_id'])) {
    header('Location: LoginController.php');
    exit;
}

require_once '../models/Client.php';
require_once '../models/ClientParticulier.php';
require_once '../models/ClientEntreprise.php';
$db = require_once '../config/database.php';

$error = '';
$message_success = ''; // Variable pour le message de succès
$client = null;

$client = Client::findByEmail($db, $_SESSION['client_email']);

if ($client) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

     
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $ice = $_POST['ice'] ?? ''; 
        $formeJuridique = $_POST['formeJuridique'] ?? ''; 
        $representant = $_POST['representant'] ?? ''; 

     
        if (empty($nom) || empty($telephone) || empty($email) || empty($adresse)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'email fourni est invalide.";
        } elseif (!preg_match("/^\d{10}$/", $telephone)) {
            $error = "Le numéro de téléphone est invalide.";
        }

        
        if (!$error) {
           
            $client->setNom($nom);
            $client->setAdresse($adresse);
            $client->setTelephone($telephone);
            $client->setEmail($email);

           
            if ($client instanceof ClientEntreprise) {
      
                $client->setIce($ice);
                $client->setFormeJuridique($formeJuridique);
                $client->setRepresentant($representant);
                $client->update($db); 
            } elseif ($client instanceof ClientParticulier) {
                $client->update($db); 
            }

            $message_success = "Vos informations ont été mises à jour avec succès.";
        }
    }

    // Extraction des données du client pour les afficher dans le formulaire
    $clientData = [
        'email' => $client->getEmail(),
        'nom' => $client->getNom(),
        'telephone' => $client->getTelephone(),
        'adresse' => $client->getAdresse(),
        'ice' => $client instanceof ClientEntreprise ? $client->getIce() : '',
        'formeJuridique' => $client instanceof ClientEntreprise ? $client->getFormeJuridique() : '', 
        'representant' => $client instanceof ClientEntreprise ? $client->getRepresentant() : '' 
    ];

    extract($clientData);
    $type_client = ($client instanceof ClientEntreprise) ? 2 : 1;
    require_once '../views/html/Profile.php'; 
} else {
    $error = "Aucun client trouvé avec cet email.";
    echo $error;
}

?>
