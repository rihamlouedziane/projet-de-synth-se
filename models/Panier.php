<?php
class Panier {
    // Attributs
    private $idPanier;
    private $idClient;
    private $idTrotinette;
    private $idPiece;
    private $quantite;
    private $dateAjout;
    private $statut;

    // Constructeur
    public function __construct($idClient, $idTrotinette = null, $idPiece = null, $quantite = 1, $statut = 'actif') {
        // Initialisation des attributs
        $this->idClient = $idClient;
        $this->idTrotinette = $idTrotinette;
        $this->idPiece = $idPiece;
        $this->quantite = $quantite;
        $this->dateAjout = date("Y-m-d H:i:s");  // Date actuelle
        $this->statut = $statut;
    }

    // Méthode pour ajouter au panier dans la base de données
    public function ajouterAuPanier($db) {
        // Requête SQL pour insérer un nouvel élément dans la table panier
        $query = "INSERT INTO panier (IDClient, IDTrotinette, IDPiece, Quantite, DateAjout, Statut) 
                  VALUES (:idClient, :idTrotinette, :idPiece, :quantite, :dateAjout, :statut)";

        // Préparation de la requête
        $stmt = $db->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(':idClient', $this->idClient, PDO::PARAM_INT);
        $stmt->bindParam(':idTrotinette', $this->idTrotinette, PDO::PARAM_INT);
        $stmt->bindParam(':idPiece', $this->idPiece, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $this->quantite, PDO::PARAM_INT);
        $stmt->bindParam(':dateAjout', $this->dateAjout);
        $stmt->bindParam(':statut', $this->statut);

        // Exécution de la requête
        try {
            $stmt->execute();
            echo "Produit ajouté au panier avec succès !";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout au panier : " . $e->getMessage();
        }
    }

    // Méthode pour récupérer tous les produits du panier d'un client
    public static function getPanierByClient($db, $idClient) {
        // Requête SQL pour récupérer tous les produits d'un client dans le panier
        $query = "SELECT p.IDPanier, p.IDTrotinette, p.IDPiece, p.Quantite, p.DateAjout, p.Statut, 
                         t.NumSerie, t.TypeTarif, t.Tarif, m.Libelle as modele_nom ,m.Photo 
                  FROM panier p
                  JOIN trotinette t ON p.IDTrotinette = t.IDTrotinette
                  JOIN modele m ON t.IDModele = m.IDModele
                  WHERE p.IDClient = :idClient AND p.Statut = 'actif'"; // Statut actif

        // Préparation de la requête
        $stmt = $db->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);

        // Exécution de la requête
        try {
            $stmt->execute();
            // Retourner tous les articles du panier
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du panier : " . $e->getMessage();
            return [];
        }
    }

    
public static function supprimerPanier($db, $idPanier) {
    
    $query = "DELETE FROM panier WHERE IDPanier = :idPanier";

   
    $stmt = $db->prepare($query);

    
    $stmt->bindParam(':idPanier', $idPanier, PDO::PARAM_INT);

   
    try {
        $stmt->execute();
        echo "Le panier a été supprimé avec succès !";
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du panier : " . $e->getMessage();
    }
}

}

?>
