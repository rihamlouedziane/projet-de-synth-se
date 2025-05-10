<?php
require_once 'Client.php';

class ClientParticulier extends Client {
    // ICE, FormeJuridique et Representant sont NULL

    public function __construct($nom, $adresse, $telephone, $email, $password, $ice = null, $forme = null, $representant = null, $isHashed = false) {
        parent::__construct($nom, $adresse, $telephone, $email, $password, 1, $isHashed);
    }

    public function save($db) {
        $stmt = $db->prepare("INSERT INTO client 
            (NomClient, Adresse, Telephone, Email, TypeClient, MotDePasse, ICE, FormeJuridique, Representant) 
            VALUES (:nom, :adresse, :telephone, :email, :type, :password, NULL, NULL, NULL)");

        $stmt->bindValue(':nom', $this->nom);
        $stmt->bindValue(':adresse', $this->adresse);
        $stmt->bindValue(':telephone', $this->telephone);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':type', 1);
        $stmt->bindValue(':password', $this->password);

        return $stmt->execute();
    }

    public function update($db) {
        // Supprimer la gestion du mot de passe ici
        $fields = [
            'NomClient = :nom',
            'Adresse = :adresse',
            'Telephone = :telephone',
            'Email = :email'
        ];
    
        // Construction de la requête UPDATE
        $query = "UPDATE client SET " . implode(', ', $fields) . " WHERE IDClient = :idClient";
        $stmt = $db->prepare($query);
    
        // Liaison des variables
        $stmt->bindValue(':nom', $this->nom);
        $stmt->bindValue(':adresse', $this->adresse);
        $stmt->bindValue(':telephone', $this->telephone);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':idClient', $this->id_client);  // Ajouter la liaison du paramètre IDClient
    
        // Exécution de la requête
        return $stmt->execute();
    }
    
}
?>


