<?php
session_start();
require_once '../../../models/Modele.php';

$db = require_once '../../../config/database.php';

$error = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $libelle = trim($_POST['libelle']);
    $puissance = trim($_POST['puissance']);
    $autonomie = trim($_POST['autonomie']);
    $type_modele = $_POST['type_modele'];

    // Répertoire de téléchargement des photos
    $uploadDir = '../../../public/uploads/image';
    $photoName = '';

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $tmpFile = $_FILES['photo']['tmp_name'];
        $originalName = basename($_FILES['photo']['name']);
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Extensions autorisées et taille maximale
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $maxSize = 2 * 1024 * 1024; // 2 Mo

        // Vérification du format et de la taille
        if (in_array($extension, $allowedExtensions) && $_FILES['photo']['size'] <= $maxSize) {
            // Générer un nom de fichier unique
            $photoName = uniqid('modele_', true) . '.' . $extension;
            $destination = $uploadDir . '/' . $photoName;

            // Déplacer le fichier téléchargé
            if (!move_uploaded_file($tmpFile, $destination)) {
                $error = "Erreur lors du téléchargement de la photo.";
            }
        } else {
            $error = "Format ou taille de photo non valide (max 2 Mo, formats : jpg, png, gif, webp).";
        }
    } else {
        $error = "Veuillez sélectionner une photo.";
    }

    // Validation des autres champs
    if (empty($error)) {
        if (empty($libelle) || empty($photoName) || empty($type_modele)) {
            $error = "Le libellé, la photo et le type de modèle sont obligatoires.";
        } elseif ($type_modele !== 'piece') {
            // Si le type n'est pas "piece", vérifier puissance et autonomie
            if (empty($puissance) || empty($autonomie)) {
                $error = "La puissance et l'autonomie sont obligatoires pour les autres types.";
            } elseif (!is_numeric($puissance) || $puissance <= 0) {
                $error = "La puissance doit être un nombre positif.";
            } elseif (!is_numeric($autonomie) || $autonomie <= 0) {
                $error = "L'autonomie doit être un nombre positif.";
            }
        }
    }

    // Si aucune erreur, enregistrer en base de données
    if (empty($error)) {
        $model = new Modele($libelle, $puissance, $autonomie, $type_modele, $photoName);

        // Sauvegarder le modèle dans la base
        if ($model->save($db)) {
            $_SESSION['success'] = "Ajout réussi !";
            header('Location: indexModelController.php');
            exit;
        } else {
            $error = "Erreur lors de l'ajout du modèle.";
        }
    }
}

require_once '../../../views/html/dashboardresponsable/modele/ajoutermodele.php';
?>
