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
        $this->idClient = $idClient;
        $this->idTrotinette = $idTrotinette;
        $this->idPiece = $idPiece;
        $this->quantite = $quantite;
        $this->dateAjout = date("Y-m-d H:i:s");
        $this->statut = $statut;
    }

    // Ajouter un article au panier
    public function ajouterAuPanier($db) {
        $query = "INSERT INTO panier (IDClient, IDTrotinette, IDPiece, Quantite, DateAjout, Statut) 
                  VALUES (:idClient, :idTrotinette, :idPiece, :quantite, :dateAjout, :statut)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':idClient', $this->idClient, PDO::PARAM_INT);
        $stmt->bindParam(':idTrotinette', $this->idTrotinette, PDO::PARAM_INT);
        $stmt->bindParam(':idPiece', $this->idPiece, PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $this->quantite, PDO::PARAM_INT);
        $stmt->bindParam(':dateAjout', $this->dateAjout);
        $stmt->bindParam(':statut', $this->statut);

        try {
            $stmt->execute();
            echo "Produit ajouté au panier avec succès !";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout au panier : " . $e->getMessage();
        }
    }

    // Récupérer tous les articles du panier d’un client
    public static function getPanierByClient($db, $idClient) {
        $query = "SELECT p.IDPanier, 
                         p.IDTrotinette, 
                         p.IDPiece,
                         p.Quantite,
                         COALESCE(t.Tarif, pi.Prix) AS Tarif,
                         COALESCE(mt.Libelle, mp.Libelle) AS modele_nom,
                         COALESCE(mt.Photo, mp.Photo) AS modele_photo,
                         t.NumSerie,
                         pi.Reference AS piece_reference
                  FROM panier p
                  LEFT JOIN trotinette t ON p.IDTrotinette = t.IDTrotinette
                  LEFT JOIN modele mt ON t.IDModele = mt.IDModele
                  LEFT JOIN piece pi ON p.IDPiece = pi.IDPiece
                  LEFT JOIN modele mp ON pi.IDModele = mp.IDModele
                  WHERE p.IDClient = :idClient AND p.Statut = 'actif'";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du panier : " . $e->getMessage();
            return [];
        }
    }

    // Supprimer un article du panier par son ID
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

    // Vider le panier d’un client (tous les articles)
    public static function viderPanier($db, $idClient) {
        $query = "DELETE FROM panier WHERE IDClient = :idClient AND Statut = 'actif'";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);

        try {
            $stmt->execute();
            echo "Le panier a été vidé avec succès !";
        } catch (PDOException $e) {
            echo "Erreur lors du vidage du panier : " . $e->getMessage();
        }
    }
}
?>
