<?php
session_start();

require_once '../../models/Client.php';
require_once '../../models/ClientParticulier.php';
require_once '../../models/ClientEntreprise.php';
$db = require_once '../../config/database.php';


$error = '';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'email que vous avez saisi est invalide.";
    } 
    else {
        $client = Client::findByEmail($db, $email); 

        if ($client === null) {
            $error = "Aucun compte trouvé avec cet email.";
        } else {

          
            if (!password_verify($password, $client->getPassword())) {
                $error = "Mot de passe incorrect.";
             

            } else {
                
                $_SESSION['client_id'] = $client->getId();
                $_SESSION['client_email'] = $client->getEmail();
                $_SESSION['type_client'] = $client->getType();
                $_SESSION['nom'] = $client->getNom();
            
                header('Location: ../dashbord.php');
                exit;
            }
        }
    }
}

require_once '../../views/auth/login.php';
?>


