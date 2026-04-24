<?php
class AchatModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérification de la trottinette en stock
 public function getTrottinette($idTrotinette) {
    
    $stmt = $this->pdo->prepare("SELECT t.*, m.Libelle, m.Puissance, m.Autonomie, m.Photo
                                 FROM Trotinette t
                                 JOIN Modele m ON t.IDModele = m.IDModele
                                 WHERE t.IDTrotinette = ?");
    
    // Exécuter la requête avec l'ID de la trottinette passé en paramètre
    $stmt->execute([$idTrotinette]);

    // Retourner le résultat de la requête sous forme de tableau associatif
    return $stmt->fetch(PDO::FETCH_ASSOC);
} 

    // Création d'un client
    public function createClient($nom, $adresse, $telephone) {
        $stmt = $this->pdo->prepare("
            INSERT INTO client (NomClient, Adresse, Telephone, TypeClient, MotDePasse) 
            VALUES (?, ?, ?, 1, 'default_password')
        ");
        $stmt->execute([$nom, $adresse, $telephone]);
        return $this->pdo->lastInsertId();
    }

public function getClientById($clientId) {
    $stmt = $this->pdo->prepare("SELECT * FROM client WHERE IDClient = :id");
    $stmt->bindValue(':id', $clientId);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Retourne directement les données brutes
        return [
            'IDClient' => $row['IDClient'],
            'NomClient' => $row['NomClient'],
            'Adresse' => $row['Adresse'],
            'Telephone' => $row['Telephone'],
            'Email' => $row['Email'],
            'TypeClient' => $row['TypeClient'],
            'ICE' => $row['ICE'] ?? null,
            'FormeJuridique' => $row['FormeJuridique'] ?? null,
            'Representant' => $row['Representant'] ?? null
        ];
    }
    return null;
}

    // Création de la commande
    public function createCommande($clientId, $total) {
        $stmt = $this->pdo->prepare("
            INSERT INTO cmdtrot (IDClient, DateCmd, Total) 
            VALUES (?, NOW(), ?)
        ");
        $stmt->execute([$clientId, $total]);
        return $this->pdo->lastInsertId();
    }

    // Insertion dans ligne commande
    public function createLigneCommande($commandeId, $trottinetteId, $prix) {
        $stmt = $this->pdo->prepare("
            INSERT INTO lignecmdtrot (IDCmdTrot, IDTrotinette, Prix)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$commandeId, $trottinetteId, $prix]);
    }

    // Mise à jour du stock
    public function updateStock($trottinetteId, $quantite) {
        $stmt = $this->pdo->prepare("
            UPDATE trotinette SET Quantite = Quantite - ? WHERE IDTrotinette = ?
        ");
        $stmt->execute([$quantite, $trottinetteId]);
    }
}
?>
