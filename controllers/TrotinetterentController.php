<?php
require_once  '../controllers/TrotinetteController.php';




use TROTYY\Controllers\TrotinetteController;

$trotinetteController = new TrotinetteController();
$products = $trotinetteController->getProductsForRent(); 


require_once '../views/html/location.php';
?>