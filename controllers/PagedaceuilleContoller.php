<?php
session_start();
try {
    $pdo = require_once '../config/database.php';  
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

require_once '../Models/Commentaire.php'; 
require_once '../Models/Internaute.php';   
require_once '../Models/Trotinette.php';   



use TROTYY\Models\Trotinette;

$commentaires = Commentaire::getCommentairesUniques($pdo);


$trotinetteModel = new Trotinette();


$trottinettes = $trotinetteModel->lister();

// Si tu veux filtrer les trottinettes par type, tu peux faire comme suit :
$type = 1;  // Exemple de type de commercialisation
$trottinettesFiltrees = $trotinetteModel->lister($type);


require_once "../views/html/paged'aceuille.php";
?>
