<?php

require_once '../models/Client.php';
require_once '../models/ClientParticulier.php';
require_once '../models/ClientEntreprise.php';
$db = require_once '../config/database.php';
session_start();

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
       
        

        if ($client) {
      
            if (password_verify($password, $client->getPassword())) {
                $_SESSION['client_id'] = $client->getId();
                $_SESSION['client_email'] = $client->getEmail();
                $_SESSION['type_client'] = $client->getType() ;
                    
            

                header('Location: ../controllers/dashbord.php');
                exit;
            } else {
                $error = "Mot de passe incorrect.";
            }
        } else {
            $error = "Aucun compte trouvé avec cet email.";
        }
    }
}
?>
