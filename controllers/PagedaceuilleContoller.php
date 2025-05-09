<?php
session_start();

try {
    $pdo = require_once '../config/database.php';
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Chargement des classes
require_once '../Models/Commentaire.php';
require_once '../Models/Internaute.php';
require_once '../Models/Trotinette.php';

use TROTYY\Models\Trotinette;

// Initialisations
$errors = [];
$success = '';

// 📩 Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');

    // Validation
    if (empty($nom)) $errors[] = "Le nom est obligatoire";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide";
    if (empty($contenu)) $errors[] = "Commentaire requis";

    if (empty($errors)) {
        try {
            $pdo->beginTransaction();

            // Vérification de l’existence de l’internaute
            $existingId = Internaut::existeParEmail($pdo, $email);

            if ($existingId) {
                $internaute_id = $existingId;
            } else {
                $internaut = new Internaut($nom, $email);
                $internaute_id = $internaut->ajouter($pdo);
            }

            $commentaire = new Commentaire($contenu, $internaute_id);
            $commentaire->ajouter($pdo);

            $pdo->commit();
            $success = "Merci pour votre commentaire !";

            // Réinitialisation des champs
            $nom = $email = $contenu = '';

        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}

// 🔄 Chargement des commentaires
$commentaires = Commentaire::getCommentairesUniques($pdo);

// 🔄 Chargement des trottinettes
$trotinetteModel = new Trotinette();
$type = 1; // type de commercialisation à filtrer si nécessaire
$trottinettes = $trotinetteModel->lister($type);

// 👉 Affichage final dans une seule vue
require_once "../views/html/paged'aceuille.php";
?>
