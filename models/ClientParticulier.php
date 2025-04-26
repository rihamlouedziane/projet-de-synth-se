<?php
require_once 'Client.php';

class ClientParticulier extends Client {
    private $prenom;
    private $dateNaissance;
    private $civilite;
    private $idRespo;

    public function __construct($nom, $prenom, $dateNaissance, $adresse, $email, $password, $civilite, $idRespo, $telephone, $isHashed = false) {
        parent::__construct($nom, $telephone, $email, $adresse, $password, $isHashed);
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->civilite = $civilite;
        $this->idRespo = $idRespo;
        $this->type_client = 'particulier';
    }

    public function save($db) {
        // Préparation de la requête avec PDO
        $stmt = $db->prepare("INSERT INTO clientparticulier 
            (Nom, Prenom, DateNaissance, Adresse, Email, Mdp, Civilite, IdRespo, tel) 
            VALUES (:nom, :prenom, :dateNaissance, :adresse, :email, :password, :civilite, 2, :telephone)");

        // Lier les paramètres aux valeurs de l'objet
        $stmt->bindValue(':nom', $this->nom);
        $stmt->bindValue(':prenom', $this->prenom);
        $stmt->bindValue(':dateNaissance', $this->dateNaissance);
        $stmt->bindValue(':adresse', $this->adresse);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':civilite', $this->civilite);

        $stmt->bindValue(':telephone', $this->telephone);

        // Exécution de la requête
        return $stmt->execute();
    }

    // Getters si besoin
    public function getPrenom() { return $this->prenom; }
    public function getDateNaissance() { return $this->dateNaissance; }
    public function getCivilite() { return $this->civilite; }
    public function getIdRespo() { return $this->idRespo; }
}
?>
