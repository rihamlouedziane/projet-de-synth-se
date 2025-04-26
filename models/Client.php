<?php
require_once 'ClientEntreprise.php';
require_once 'ClientParticulier.php';

abstract class Client {
    protected $id_client;
    protected $nom;
    protected $telephone;
    protected $email;
    protected $adresse;
    protected $password;
    protected $type_client;

    public function __construct($nom, $telephone, $email, $adresse, $password, $isHashed = false) {
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);
    }

    public static function findByEmail($db, $email) {
        // Requête pour trouver un client entreprise
        $query = "
        SELECT 
            IdCE AS id, 
            NomCE AS Nom, 
            NULL AS Prenom, 
            NULL AS DateNaissance, 
            Adresse, 
            EmailCE AS Email, 
            Mdp, 
            NULL AS Civilite, 
            NumeroICE As NumeroSiret, 
            SecteurActivite, 
            'entreprise' AS type_client, 
            tel, 
            NULL AS IdRespo 
        FROM cliententreprise 
        WHERE EmailCE = :email
    ";
    
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        // Si un client est trouvé dans cliententreprise
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $client = new ClientEntreprise(
                $row['Nom'],                // nom
                $row['Adresse'],            // adresse
                $row['Email'],              // email
                $row['NumeroSiret'],        // numeroICE
                $row['SecteurActivite'],    // secteurActivite
                2,                          // idRespo (valeur fixe ici)
                $row['tel'],                // telephone
                $row['Mdp'],                // password
                true                        // Indique que le mot de passe est déjà hashé
            );
            
            $client->setId($row['id']);
            return $client;
        }
    
        // Si pas trouvé dans cliententreprise, recherche dans clientparticulier
        $query = "
        SELECT IdCP AS id, Nom, Prenom, DateNaissance, Adresse, Email, Mdp, Civilite, 'particulier' AS type_client, tel, IdRespo 
        FROM clientparticulier 
        WHERE Email = :email
        ";
    
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        // Si un client est trouvé dans clientparticulier
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Créer un objet ClientParticulier
            $client = new ClientParticulier(
                $row['Nom'], 
                $row['Prenom'],  
                $row['DateNaissance'],  
                $row['Adresse'], 
                $row['Email'], 
                $row['Mdp'], 
                $row['Civilite'], 
                $row['IdRespo'], 
                $row['tel'], 
                true // Indique que le mot de passe est déjà hashé
            );
            $client->setId($row['id']);
            return $client;
        }
    
        // Aucun client trouvé
        return null;
    }

    public function getId() {
        return $this->id_client;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getType() {
        return $this->type_client;
    }

    // Méthode pour vérifier le mot de passe
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    // Setter pour l'ID (utile après la récupération du client)
    public function setId($id) {
        $this->id_client = $id;
    }
}
?>
