<?php
require_once 'ClientEntreprise.php';
require_once 'ClientParticulier.php';
abstract class Client {
    protected $id_client;
    protected $nom;
    protected $adresse;
    protected $telephone;
    protected $email;
    protected $password;
    protected $type_client; // 1 = particulier, 2 = entreprise

    public function __construct($nom, $adresse, $telephone, $email, $password, $type_client, $isHashed = false) {
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);
        $this->type_client = $type_client;
    }

    public static function findByEmail($db, $email) {
        $stmt = $db->prepare("SELECT * FROM client WHERE Email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['TypeClient'] == 1) {
                $client = new ClientParticulier(
                    $row['NomClient'], 
                    $row['Adresse'], 
                    $row['Telephone'], 
                    $row['Email'],
                    $row['MotDePasse'], 
                    null, 
                    null, 
                    null, 
                    true
                );
            } else {
                $client = new ClientEntreprise(
                    $row['NomClient'], 
                    $row['Adresse'], 
                    $row['Telephone'], 
                    $row['Email'],
                    $row['MotDePasse'], 
                    $row['ICE'], 
                    $row['FormeJuridique'], 
                    $row['Representant'], 
                    true
                );
            }
        
            $client->setId($row['IDClient']);
            return $client;
        }
        
    }

    public function getId() { return $this->id_client; }
    public function getNom() { return $this->nom; }
    public function getAdresse() { return $this->adresse; }
    public function getTelephone() { return $this->telephone; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getType() { return $this->type_client; }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
    
    

    public function setId($id) {
        $this->id_client = $id;
    }

    abstract public function save($db);
}
?>
