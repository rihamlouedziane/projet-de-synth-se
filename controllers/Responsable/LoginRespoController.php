<?php
session_start();

require_once '../../models/Responsable.php';


$db = require_once '../../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'email que vous avez saisi est invalide.";
    } 
    else {
        // On recherche un responsable, pas un client
        $responsable = Responsable::findByEmail($db, $email);

        if ($responsable === null) {
            $error = "Aucun compte trouvé avec cet email.";
        } else {
            // Vérification du mot de passe
            if (!password_verify($password, $responsable->getPassword())) {
                $error = "Mot de passe incorrect.";
            } else {
                // Connexion réussie : on stocke l'ID du responsable
                $_SESSION['responsable_id']   = $responsable->getId();
                $_SESSION['responsable_email'] = $responsable->getEmail();
                
                // Redirection vers le dashboard des responsables
                header('Location: ../Responsable/dashboardResponsableController.php');
                exit;
            }
        }
    }
}

// Affichage du formulaire de login (avec éventuellement $error)
require_once '../../views/auth/loginRespo.php';
