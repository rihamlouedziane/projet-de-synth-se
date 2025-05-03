<?php
require_once '../../../models/Modele.php';
$db = require_once '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $libelle = isset($_POST['libelle']) ? trim($_POST['libelle']) : '';
    $puissance = isset($_POST['puissance']) ? trim($_POST['puissance']) : '';
    $autonomie = isset($_POST['autonomie']) ? trim($_POST['autonomie']) : '';
    $type_modele = isset($_POST['typemodele']) ? $_POST['typemodele'] : '';
    $photo = isset($_POST['photoActuelle']) ? $_POST['photoActuelle'] : ''; 


    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $uploadDir = __DIR__ . '/../../../public/uploads/image';
        $tmpFile = $_FILES['photo']['tmp_name'];
        $originalName = basename($_FILES['photo']['name']);
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $maxSize = 2 * 1024 * 1024;

        if (in_array($extension, $allowedExtensions) && $_FILES['photo']['size'] <= $maxSize) {
            $photoName = uniqid('modele_', true) . '.' . $extension;
            $destination = $uploadDir . '/' . $photoName;

            if (move_uploaded_file($tmpFile, $destination)) {
                $photo = $photoName; 
            } else {
                $error = "Erreur lors du téléchargement de la nouvelle photo.";
            }
        } else {
            $error = "Format ou taille de photo non valide (max 2 Mo, jpg/png/gif/webp).";
        }
    }


    if (empty($libelle) || empty($puissance) || empty($autonomie) || empty($type_modele)) {
        $error = "Tous les champs doivent être remplis.";
    } elseif (!is_numeric($puissance) || $puissance <= 0) {
        $error = "La puissance doit être un nombre positif.";
    } elseif (!is_numeric($autonomie) || $autonomie <= 0) {
        $error = "L'autonomie doit être un nombre positif.";
    }

  
    if (empty($error)) {
        $success = Modele::update($db, $id, $libelle, $puissance, $autonomie, $type_modele, $photo);
        if ($success) {
            header("Location: ../Modele/indexModelController.php?success=1");
            exit();
        } else {
            header("Location: ../Modele/ModifierModelCo.php?error=1");
            exit();
        }
    } else {
        header("Location: ../Modele/ModifierModelCo.php?error=" . urlencode($error));
        exit();
    }
}
?>
