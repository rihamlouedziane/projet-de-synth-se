<?php
require_once 'Client.php';
class ClientEntreprise extends Client {
    private $numeroICE;
    private $secteurActivite;
    private $idRespo;

    public function __construct($nom, $adresse, $email, $numeroICE, $secteurActivite,$idRespo ,$telephone, $password, $isHashed = false) {
        parent::__construct($nom, $telephone, $email, $adresse, $password, $isHashed ); 
        $this->type_client = 'entreprise';  
        $this->numeroICE = $numeroICE;
        $this->secteurActivite = $secteurActivite;
        $this->idRespo = $idRespo;
    }

    public function save($db) {

    
        // Spécifier les colonnes dans la requête INSERT
        $stmt = $db->prepare("INSERT INTO cliententreprise 
            (NomCE, Adresse, EmailCE, NumeroICE, SecteurActivite, IdRespo, tel, Mdp) 
            VALUES (:nomCE, :adresse, :emailCE, :numeroICE, :secteur, :idRespo, :tel, :password)");
    
        // Lier les valeurs
        $stmt->bindValue(':nomCE', $this->nom); 
        $stmt->bindValue(':adresse', $this->adresse);  
        $stmt->bindValue(':emailCE', $this->email); 
        $stmt->bindValue(':numeroICE', $this->numeroICE);  
        $stmt->bindValue(':secteur', $this->secteurActivite);  
        $stmt->bindValue(':idRespo', 2); 
        $stmt->bindValue(':tel', $this->telephone);  
        $stmt->bindValue(':password', $this->password);  
    
        return $stmt->execute();  
    }
    
}
?>
