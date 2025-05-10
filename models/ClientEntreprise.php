<?php
require_once 'Client.php';

class ClientEntreprise extends Client {
    private $ice;
    private $formeJuridique;
    private $representant;

    public function __construct($nom, $adresse, $telephone, $email, $password, $ice, $formeJuridique, $representant, $isHashed = false) {
        parent::__construct($nom, $adresse, $telephone, $email, $password, 2, $isHashed);
        $this->ice = $ice;
        $this->formeJuridique = $formeJuridique;
        $this->representant = $representant;
    }
 
    // Getters
    public function getIce() {
        return $this->ice;
    }

    public function getFormeJuridique() {
        return $this->formeJuridique;
    }

    public function getRepresentant() {
        return $this->representant;
    }

 
    public function setIce($ice) {
        $this->ice = $ice;
    }

    public function setFormeJuridique($formeJuridique) {
        $this->formeJuridique = $formeJuridique;
    }

    public function setRepresentant($representant) {
        $this->representant = $representant;
    }

    public function update($db) {
        // Supprimer la gestion du mot de passe ici
        $fields = [
            'NomClient = :nom',
            'Adresse = :adresse',
            'Telephone = :telephone',
            'Email = :email',
            'ICE = :ice',
            'FormeJuridique = :formeJuridique',
            'Representant = :representant'
        ];

        $query = "UPDATE client SET " . implode(', ', $fields) . " WHERE IDClient = :idClient";
        $stmt = $db->prepare($query);

        // Liaison des variables
        $stmt->bindValue(':nom', $this->nom);
        $stmt->bindValue(':adresse', $this->adresse);
        $stmt->bindValue(':telephone', $this->telephone);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':ice', $this->ice);
        $stmt->bindValue(':formeJuridique', $this->formeJuridique);
        $stmt->bindValue(':representant', $this->representant);
        $stmt->bindValue(':idClient', $this->id_client);

        return $stmt->execute();
    }



    public function save($db) {
        $stmt = $db->prepare("INSERT INTO client 
            (NomClient, Adresse, Telephone, Email, TypeClient, MotDePasse, ICE, FormeJuridique, Representant) 
            VALUES (:nom, :adresse, :telephone, :email, :type, :password, :ice, :forme, :representant)");

        $stmt->bindValue(':nom', $this->nom);
        $stmt->bindValue(':adresse', $this->adresse);
        $stmt->bindValue(':telephone', $this->telephone);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':type', 2); 
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':ice', $this->ice);
        $stmt->bindValue(':forme', $this->formeJuridique);
        $stmt->bindValue(':representant', $this->representant);

        return $stmt->execute();
    }
}
?>
