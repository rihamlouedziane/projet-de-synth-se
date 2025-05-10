<?php
require_once '../../models/Responsable.php';
$db = require_once '../../config/database.php';

// 1. Instanciation « à la main »
$respo = new Responsable(
    null,                // ID (sera remis par la BDD après insert)
    'riham',            // Prénom
    'louedziane',         // Nom
    'rihamlouedziane@gmail.com',// Email
    '0612345678',        // Téléphone
    '12345678' , // Mot de passe en clair
    false 
);

// 2. Enregistrement en base
$respo->save($db);

// 3. Affichage de l’ID généré
echo "Nouveau responsable créé avec l'ID : " . $respo->getId();

