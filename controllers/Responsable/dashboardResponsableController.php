<?php
session_start();


if (!isset($_SESSION['responsable_id'])) {
    header('Location: LoginRespoController.php');
    exit;
}


require_once '../../models/Responsable.php';

$db = require_once '../../config/database.php';



$respo = Responsable::findByEmail($db, $_SESSION['responsable_email']);

if ($respo) {

    $respoData = [
        'prenom'   => $respo->getPrenom(),
        'nom'      => $respo->getNom(),
        'email'    => $respo->getEmail(),
        'telephone'=> $respo->getTel()
    ];

    extract($respoData);
 
    require_once '../../views/html/dashboardresponsable/pagedaceuille.php';
} else {
    echo "Aucun responsable trouvé.";
}
?>
