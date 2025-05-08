<?php
namespace TROTYY\Models;
use PDO;
use PDOException;

class Trotinette {
    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php'; 
    }

    public function lister(?int $type = null): array {
        $query = "SELECT t.*, m.Libelle, m.Puissance, m.Autonomie ,m.Photo
                  FROM Trotinette t
                  JOIN Modele m ON t.IDModele = m.IDModele";

        if ($type !== null) {
            $query .= " WHERE t.TypeCommercialisation = :type";
        }

        $stmt = $this->db->prepare($query);

        try {
            if ($type !== null) {
                $stmt->execute([':type' => $type]);
            } else {
                $stmt->execute();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération: " . $e->getMessage());
            return [];
        }
    }
}
