<?php
require_once '../../../models/Modele.php';
$db = require_once '../../../config/database.php';


$error = '';
$modele = null; 


session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    

    $modele = Modele::getById($db, $id);

    // Vérifier si le modèle existe
    if (!$modele) {
        $error = "Aucun modèle trouvé avec cet ID.";
    } else {
        // Si le modèle existe, stockez les données dans la session
        $_SESSION['modele'] = [
            'id' => $modele['IDModele'],
            'libelle' => $modele['Libelle'],
            'puissance' => $modele['Puissance'],
            'autonomie' => $modele['Autonomie'],
            'type_modele' => $modele['TypeModele'],
            'photo' =>$modele['Photo']
        ];
    }
}

// Vérifier s'il y a une erreur et l'afficher
if ($error) {
    echo $error;
}

// Inclure la vue pour afficher le formulaire de modification du modèle
require_once '../../../views/html/dashboardresponsable/modele/modifiermodele.php';
?>
