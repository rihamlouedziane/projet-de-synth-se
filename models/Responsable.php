<?php

class Responsable {
    private $id;
    private $Prenom;
    private $Nom;
    private $Email;
    private $Tel;
    private $password;

    public function __construct($id, $Prenom, $Nom, $Email, $Tel, $password, $isHashed = true) {
        $this->id       = $id;
        $this->Prenom   = $Prenom;
        $this->Nom      = $Nom;
        $this->Email    = $Email;
        $this->Tel      = $Tel;
        $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);
    }

    // Méthode d'enregistrement existante
    public function save($db) {
        $sql = "INSERT INTO responsable (PrenomRespo, NomRespo, EmailRespo, TelRespo, Mdp) 
                VALUES (:prenom, :nom, :email, :tel, :mdp)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':prenom' => $this->Prenom,
            ':nom'    => $this->Nom,
            ':email'  => $this->Email,
            ':tel'    => $this->Tel,
            ':mdp'    => $this->password
        ]);
        // Récupère l'ID généré
        $this->id = $db->lastInsertId();
    }

    // Nouvelle méthode : rechercher un responsable par email
    public static function findByEmail(PDO $db, string $email): ?Responsable {
        $sql = "SELECT IDRespo, PrenomRespo, NomRespo, EmailRespo, TelRespo, Mdp
                FROM responsable
                WHERE EmailRespo = :email
                LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Responsable(
            $row['IDRespo'],
            $row['PrenomRespo'],
            $row['NomRespo'],
            $row['EmailRespo'],
            $row['TelRespo'],
            $row['Mdp'],
            true  
        );
    }

    // Accesseurs (getters)
    public function getId(): int {
        return $this->id;
    }
    public function getPrenom(): string {
        return $this->Prenom;
    }
    public function getNom(): string {
        return $this->Nom;
    }
    public function getEmail(): string {
        return $this->Email;
    }
    public function getTel(): string {
        return $this->Tel;
    }
    public function getPassword(): string {
        return $this->password;
    }
}
