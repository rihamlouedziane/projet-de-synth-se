<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


// Include required files
require_once '../config/database.php';
require_once  '../models/Trotinette.php';
require_once  '../controllers/TrotinetteController.php';





// Initialize controller and get products
try {
    $controller = new TROTYY\Controllers\TrotinetteController();
    
   
    $category = $_GET['category'] ?? 0;
    $limit = $_GET['limit'] ?? 12; // Default to 12 products
    
    // Get filtered products
    $trottinettes = $controller->getProductsForSale($limit, $category);
    
    // Ensure we have an array even if empty
    if (!is_array($trottinettes)) {
        $trottinettes = [];
        error_log("Warning: getProductsForSale() did not return an array");
    }
} catch (Exception $e) {
    // Handle errors gracefully
    $trottinettes = [];
    error_log("Error loading products: " . $e->getMessage());
    $errorMessage = "Error loading products. Please try again later.";
}

require_once '../views/html/sell.php';
?>

