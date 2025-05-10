<?php
class Piece {

    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php'; 
    }

    // Méthode statique pour récupérer toutes les pièces
    public static function getAllPieces($pdo) {
        $query = "SELECT p.*, m.Libelle, m.Photo
                  FROM piece p
                  JOIN modele m ON p.IDModele = m.IDModele";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
