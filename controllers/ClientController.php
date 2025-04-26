<?php
session_start();
require_once '../models/Client.php';
require_once '../models/ClientParticulier.php';
require_once '../models/ClientEntreprise.php';

$db = require_once '../config/database.php';

$error = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type_client'];
    $nom = trim($_POST['nom']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $adresse = trim($_POST['adresse']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);  


    if (empty($nom) || empty($telephone) || empty($email) || empty($adresse) || empty($password) || empty($confirmPassword)) {
        $error = "Tous les champs sont obligatoires.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
        $error = "L'email fourni est invalide.";
    } 
    elseif (!preg_match("/^\d{10}$/", $telephone)) {
        $error = "Le numéro de téléphone est invalide.";
    } 
    elseif (strlen($password) < 8) {
        $error = "Le mot de passe doit contenir au moins 8 caractères.";
    } 
    elseif ($password !== $confirmPassword) {  
        $error = "Les mots de passe ne correspondent pas.";
    } else {
       
        if ($type === 'particulier') {
            $prenom = trim($_POST['prenom']);
            $naissance = trim($_POST['date_naissance']);
            $civilite = trim($_POST['civilite']);

            if (empty($prenom) || empty($naissance) || empty($civilite)) {
                $error = "Tous les champs doivent être remplis pour un particulier.";
            } else {
                $client = new ClientParticulier($nom, $prenom, $naissance, $adresse, $email, $password, $civilite, null, $telephone); 
            }
        } 
        else if ($type === 'entreprise') {
            $siret = trim($_POST['siret']);
            $secteur = trim($_POST['secteur']);

            if (empty($siret) || empty($secteur)) {
                $error = "Tous les champs doivent être remplis pour une entreprise.";
            } else {
                $client = new ClientEntreprise($nom, $adresse, $email, $siret, $secteur, null, $telephone, $password );
            }
        }

        if (empty($error) && isset($client)) {
            if ($client->save($db)) {
                    session_start();
                $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        
           
                header('Location: ../views/auth/login.php'); 
                exit;
            } else {
                $error = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
        
    }
}


 require_once '../views/auth/sign.php';
?>
