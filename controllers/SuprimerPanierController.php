<?php
session_start();
require_once '../models/Panier.php';
$db = require_once '../config/database.php';

if (isset($_SESSION['client_id'])) {
    if (isset($_GET['idPanier'])) {
        $idPanier = $_GET['idPanier'];
        $idClient = $_SESSION['client_id']; 
        
       
        Panier::supprimerPanier($db, $idPanier);
        
      
        header("Location: IndexPanierController.php"); 
        exit;
    }
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: ../Controllers/Client/LoginController.php");
    exit;
}
?>
