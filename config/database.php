<?php
$host = "localhost";
$dbname = "trottinettesdb";
$username = "root";
$password = "7/12/2004";

try {
    // Création de la connexion avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configuration du mode d'erreur pour PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Retourner la connexion
    return $pdo;
    
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    die("Connection failed: " . $e->getMessage());
}
?>
