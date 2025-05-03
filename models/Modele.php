<?php
class Modele {
    private $Libelle;
    private $Puissance;
    private $Autonomie;
    private $TypeModele;
    private $Photo; 

    public function __construct($Libelle, $Puissance, $Autonomie, $TypeModele, $Photo = null) {
        $this->Libelle     = $Libelle;
        $this->Puissance   = $Puissance;
        $this->Autonomie   = $Autonomie;
        $this->TypeModele  = $TypeModele;
        $this->Photo       = $Photo;
    }


    public function save($db) {
        $stmt = $db->prepare("INSERT INTO modele 
            (Libelle, Puissance, Autonomie, TypeModele, Photo) 
            VALUES (:libelle, :puissance, :autonomie, :type, :photo)");

        $stmt->bindValue(':libelle', $this->Libelle);
        $stmt->bindValue(':puissance', $this->Puissance);
        $stmt->bindValue(':autonomie', $this->Autonomie);
        $stmt->bindValue(':type', $this->TypeModele);
        $stmt->bindValue(':photo', $this->Photo);

        return $stmt->execute();
    }

    // Récupérer tous les modèles
    public static function index($db) {
        $stmt = $db->prepare("SELECT * FROM modele");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un modèle par son ID
    public static function getById($db, $id) {
        $stmt = $db->prepare("SELECT * FROM modele WHERE IDModele = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($db, $id, $libelle, $puissance, $autonomie, $type_modele, $photo) {
        $sql = "UPDATE modele 
                SET Libelle = :libelle, 
                    Puissance = :puissance, 
                    Autonomie = :autonomie, 
                    TypeModele = :type_modele, 
                    Photo = :photo 
                WHERE IDModele = :id";
    
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->bindParam(':puissance', $puissance);
        $stmt->bindParam(':autonomie', $autonomie);
        $stmt->bindParam(':type_modele', $type_modele);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }
    

    
    public static function delete($db, $id) {
        $stmt = $db->prepare("DELETE FROM piece WHERE IDModele = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $db->prepare("DELETE FROM trotinette WHERE IDModele = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $db->prepare("DELETE FROM modele WHERE IDModele = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // ✅ Getter pour la photo
    public function getPhoto() {
        return $this->Photo;
    }

    // Autres getters
    public function getLibelle() {
        return $this->Libelle;
    }

    public function getPuissance() {
        return $this->Puissance;
    }

    public function getAutonomie() {
        return $this->Autonomie;
    }

    public function getTypeModele() {
        return $this->TypeModele;
    }
}
?>
