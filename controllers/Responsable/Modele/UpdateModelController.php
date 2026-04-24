<?php
require_once '../../../models/Modele.php';
$db = require_once '../../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $libelle = isset($_POST['libelle']) ? trim($_POST['libelle']) : '';
    $puissance = isset($_POST['puissance']) ? trim($_POST['puissance']) : '';
    $autonomie = isset($_POST['autonomie']) ? trim($_POST['autonomie']) : '';
    $type_modele = isset($_POST['typemodele']) ? $_POST['typemodele'] : '';
   $photo = isset($_POST['existing_photo']) ? $_POST['existing_photo'] : '';
  $error = '';

  
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
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
                // Supprimer l'ancienne photo seulement si elle existe
                if (!empty($existingPhoto) && file_exists($uploadDir . '/' . $existingPhoto)) {
                    unlink($uploadDir . '/' . $existingPhoto);
                }
                $photo = $photoName; 
            } else {
                $error = "Erreur lors du téléchargement de la nouvelle photo.";
                header("Location: ../Modele/ModifierModelCo.php?error=" . urlencode($error) . "&id=" . $id);
                exit();
            }
        } else {
            $error = "Format ou taille de photo non valide (max 2 Mo, jpg/png/gif/webp).";
            header("Location: ../Modele/ModifierModelCo.php?error=" . urlencode($error) . "&id=" . $id);
            exit();
        }
    }


    // Validate fields
    if (empty($libelle) || empty($type_modele)) {
        $error = "Les champs Libellé et Type de modèle sont obligatoires.";
    } else {
        if ($type_modele === 'trottinette') {
            if (empty($puissance) || empty($autonomie)) {
                $error = "Pour les trottinettes, la puissance et l'autonomie sont requises.";
            } elseif (!is_numeric($puissance) || $puissance <= 0) {
                $error = "La puissance doit être un nombre positif.";
            } elseif (!is_numeric($autonomie) || $autonomie <= 0) {
                $error = "L'autonomie doit être un nombre positif.";
            }
        } else {
            // Handle piece type
            $puissance = empty($puissance) ? null : $puissance;
            $autonomie = empty($autonomie) ? null : $autonomie;

            if ($puissance !== null && (!is_numeric($puissance) || $puissance <= 0)) {
                $error = "La puissance doit être un nombre positif si fournie.";
            }
            if ($autonomie !== null && (!is_numeric($autonomie) || $autonomie <= 0)) {
                $error = "L'autonomie doit être un nombre positif si fournie.";
            }
        }
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
        header("Location: ../Modele/ModifierModelCo.php?error=" . urlencode($error) . "&id=" . $id);
        exit();
    }
}