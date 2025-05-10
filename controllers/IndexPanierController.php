<?php
session_start();
require_once '../models/Panier.php';
$db = require_once '../config/database.php';


if (isset($_SESSION['client_id'])) {
    
    $idClient = $_SESSION['client_id']; 

  
    $paniers = Panier::getPanierByClient($db, $idClient);
    
   

    require_once '../views/html/panier.php';
} else {
    
    header("Location: ../Controllers/Client/LoginController.php");
    exit;
}
?>


