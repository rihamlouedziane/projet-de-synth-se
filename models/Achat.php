<?php
class AchatModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérification de la trottinette en stock
    public function getTrottinette($idTrotinette) {
        $stmt = $this->pdo->prepare("SELECT Tarif, Quantite FROM trotinette WHERE IDTrotinette = ?");
        $stmt->execute([$idTrotinette]);
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
