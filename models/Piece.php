<?php
class Piece {
    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php'; 
    }

    // Méthode pour récupérer toutes les pièces
    public static function getAllPieces($pdo) {
        $query = "SELECT p.*, m.Libelle, m.Photo
                  FROM piece p
                  JOIN modele m ON p.IDModele = m.IDModele";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer une pièce spécifique
    public static function getPieceById($pdo, $id) {
        $query = "SELECT p.*, m.Libelle, m.Photo
                  FROM piece p
                  JOIN modele m ON p.IDModele = m.IDModele
                  WHERE p.IDPiece = :id";

        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour vérifier la disponibilité
   /* public static function checkAvailability($pdo, $id, $quantity) {
        $query = "SELECT QuantiteStock FROM piece WHERE IDPiece = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result && $result['QuantiteStock'] >= $quantity);
    }*/
}
?>
