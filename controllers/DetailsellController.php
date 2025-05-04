<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Include required files
require_once '../config/database.php';
require_once '../Models/Trotinette.php';
require_once '../Controllers/TrotinetteController.php';
session_start();

// Get product ID from URL
$productId = $_GET['id'] ?? 0;

try {
    $controller = new TROTYY\Controllers\TrotinetteController();
    $product = $controller->getProductDetails($productId);
    
    if (!$product) {
        throw new Exception("Product not found");
    }
} catch (Exception $e) {
    // Handle errors
    error_log("Error loading product: " . $e->getMessage());
    header("Location: sell.php");
    exit();
}
require_once '../views/html/details.php';
?>