<?php

class Internaut {
    private $nom;
    private $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    // Vérifie si l'email existe déjà
    public static function existeParEmail($pdo, $email) {
        $sql = "SELECT id FROM internaute WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function ajouter($pdo) {
        $sql = "INSERT INTO internaute (nom, email) VALUES (:nom, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email
        ]);
        return $pdo->lastInsertId();
    }
}  

?>
