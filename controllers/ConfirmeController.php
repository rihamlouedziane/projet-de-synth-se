<?php 
session_start();
require_once "../controllers/CmdTrotController.php"; 

 $cmdtrot= new CmdTrotController();
    $result=$cmdtrot->createOrder();
    


require_once '../views/html/confirmation.php';
?>