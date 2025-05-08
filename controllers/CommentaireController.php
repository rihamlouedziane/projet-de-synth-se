<?php

try {
    $pdo = require_once '../config/database.php';
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

require_once '../Models/Commentaire.php';
require_once '../Models/Internaute.php';

$errors = [];
$success = '';

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

            // Vérification de l'existence de l'email
            $existingId = Internaut::existeParEmail($pdo, $email);

            if ($existingId) {
                $internaute_id = $existingId;
            } else {
                // Création du nouvel internaute
                $internaut = new Internaut($nom, $email);
                $internaute_id = $internaut->ajouter($pdo);
            }

            // Création du commentaire
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

require_once '../views/html/commentaire.php';
?>