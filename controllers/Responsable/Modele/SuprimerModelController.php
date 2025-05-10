<?php
require_once '../../../models/Modele.php';
$db = require_once '../../../config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = trim($_GET['id']);

     
        $success = Modele::delete($db, $id);

        if ($success) {
       
            header("Location: ../Modele/indexModelController.php?success=1");
            exit();
        } else {
          
            header("Location: ../Modele/indexModelController.php?error=1");
            exit();
        }
    } else {
    
        header("Location: ../Modele/indexModelController.php?error=missing_id");
        exit();
    }
} else {
 
    header("Location: ../Modele/indexModelController.php");
    exit();
}
?>
