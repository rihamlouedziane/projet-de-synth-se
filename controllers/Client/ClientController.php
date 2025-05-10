<?php
session_start();
require_once   '../../models/Client.php';
require_once   '../../models/ClientParticulier.php';
require_once   '../../models/ClientEntreprise.php';


$db = require_once   '../../config/database.php';


$error = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type =$_POST['type_client'];
    $nom = trim($_POST['nom']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $adresse = trim($_POST['adresse']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);  

    if (empty($type) || !in_array($type, ['particulier', 'entreprise'])) {
        $error = "Le type de client n'est pas valide.";
    } 

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
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM client WHERE Email = :email");
        $checkStmt->bindValue(':email', $email);
        $checkStmt->execute();
        $emailExists = $checkStmt->fetchColumn() > 0;
    
        if ($emailExists) {
            $error = "Cette adresse email est déjà utilisée.";
        }
    
        if (empty($error)) {
            if ($type === 'particulier') {
                
                $client = new ClientParticulier($nom, $adresse, $telephone, $email, $password);

            } 
            else if ($type === 'entreprise') {
                $ice = trim($_POST['ice']);
                $formeJuridique = trim($_POST['forme_juridique']);
                $representant = trim($_POST['representant']);
    
                if (empty($ice) || empty($formeJuridique) || empty($representant)) {
                    $error = "Tous les champs doivent être remplis pour une entreprise.";
                } else {
                
                    $client = new ClientEntreprise($nom, $adresse, $telephone, $email, $password, $ice, $formeJuridique, $representant);
                }
            } else {
                $error = "Le type de client n'est pas valide.";
            }
        }
    

        if (empty($error) && isset($client)) {
            if ($client->save($db)) {
                $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header('Location: ../Client/LoginController.php'); 
                exit;
            } else {
                $error = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
        
    }
}

require_once '../../views/auth/sign.php';
?>
