<?php

class CmdtrotController {
    private $db;
    private $panierModel;

    public function __construct() {
        define('__ROOT__', dirname(dirname(__FILE__))); 
        require_once (__ROOT__ . '/models/Panier.php');
        $this->db = require_once (__ROOT__.'/config/database.php');
      
    }

    /**
     * Ajouter une trottinette au panier
     */
  /*   public function addToCart() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['client_id'])) {
            echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter']);
            exit();
        }

        // Valider les données d'entrée
        $idtrotinette = filter_input(INPUT_POST, 'idtrotinette', FILTER_VALIDATE_INT);
        $quantite = filter_input(INPUT_POST, 'quantite', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if (!$idtrotinette || !$quantite) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            exit();
        }

        try {
            // Vérifier la disponibilité de la trottinette
            $stmt = $this->db->prepare("SELECT * FROM trotinette WHERE idtrotinette = :id ");
            $stmt->execute([':id' => $idtrotinette]);
            $trotinette = $stmt->fetch();

            if (!$trotinette) {
                echo json_encode(['success' => false, 'message' => 'Trottinette non disponible']);
                exit();
            }

            // Ajouter au panier
            $this->panierModel = new Panier(
                $_SESSION['client_id'],
                $idtrotinette,
                null, // Pas de pièce pour l'instant
                $quantite,
                'actif'
            );
            $result = $this->panierModel->ajouterAuPanier($this->db);

            if ($result== "success") {
                echo json_encode(['success' => true, 'message' => 'Ajouté au panier']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout'.$result]);
            }

        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()]);
        }
    } */

    /**
     * Créer une commande de trottinette
     */
  public function createOrder() {
    // First check if user is logged in
    if (!isset($_SESSION['client_id'])) {
        echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter']);
        return false;
    }

    // Then initialize the Panier model
    $this->panierModel = new Panier(
        $_SESSION['client_id'],
        null,
        null,
        null,
        'actif'
    );

    try {
        // 1. Create main order
        $stmt = $this->db->prepare("
            INSERT INTO cmdtrot (datecmd, idclient, idrespo, total) 
            VALUES (NOW(), :clientId, NULL, 0)
        ");
        $stmt->execute([':clientId' => $_SESSION['client_id']]);
        $idcmdtrot = $this->db->lastInsertId();

        // 2. Get cart items
        $items = $this->panierModel->getPanierByClient($this->db, $_SESSION['client_id']);
        $total = 0;

        // 3. Add each item to the order
        foreach ($items as $item) {
            if (isset($item['IDTrotinette'])) { // It's a scooter
                $stmt = $this->db->prepare("
                    INSERT INTO lignecmdtrot (IDCmdTrot, IDTrotinette, Prix)
                    VALUES (:orderId, :trotId, :price)
                ");
                $stmt->execute([
                    ':orderId' => $idcmdtrot,
                    ':trotId' => $item['IDTrotinette'],
                    ':price' => $item['Tarif']
                ]);

                $total += $item['Tarif'];
            } 
            elseif (isset($item['IDPiece'])) { // It's a part
                $stmt = $this->db->prepare("
                    INSERT INTO cmdpiece (Date, IDClient, IDRespo, Total)
                    VALUES (NOW(), :clientId, NULL, 0)
                ");
                $stmt->execute([':clientId' => $_SESSION['client_id']]);
                $idCmdPiece = $this->db->lastInsertId();

                $price = isset($item['Prix']) ? $item['Prix'] : $item['Tarif'];

                $stmt = $this->db->prepare("
                    INSERT INTO lignecmdpiece (IDCmdPiece, IDPiece, Prix, Qte, SousTotal)
                    VALUES (:orderId, :pieceId, :price, :quantity, :price * :quantity)
                ");
                $stmt->execute([
                    ':orderId' => $idCmdPiece,
                    ':pieceId' => $item['IDPiece'],
                    ':price' => $price,
                    ':quantity' => $item['Quantite']
                ]);

                // Update parts order total
                $subTotal = $price * $item['Quantite'];
                $stmt = $this->db->prepare("
                    UPDATE cmdpiece 
                    SET Total = :total 
                    WHERE IDCmdPiece = :id
                ");
                $stmt->execute([
                    ':total' => $subTotal,
                    ':id' => $idCmdPiece
                ]);

                $total += $subTotal;
            }
        }

        // 4. Update main order total
        $stmt = $this->db->prepare("
            UPDATE cmdtrot 
            SET total = :total 
            WHERE idcmdtrot = :id
        ");
        $stmt->execute([
            ':total' => $total,
            ':id' => $idcmdtrot
        ]);

        // 5. Empty the cart
        $this->panierModel->viderPanier($this->db, $_SESSION['client_id']);

        echo json_encode([
            'success' => true,
            'message' => 'Commande créée',
            'orderId' => $idcmdtrot
        ]);
        return true;
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()]);
        return false;
    }
}
    /**
     * Récupérer les commandes d'un client
     */
    public function getClientOrders() {
    if (!isset($_SESSION['client_id'])) {
        echo json_encode(['success' => false, 'message' => 'Non autorisé']);
        exit();
    }

    try {
        // Récupérer les commandes de trottinettes
        $stmt = $this->db->prepare("
            SELECT c.*, COUNT(l.idtrotinette) as nb_items 
            FROM cmdtrot c
            LEFT JOIN lignecmdtrot l ON c.idcmdtrot = l.idcmdtrot
            WHERE c.idclient = :clientId
            GROUP BY c.idcmdtrot
            ORDER BY c.datecmd DESC
        ");
        $stmt->execute([':clientId' => $_SESSION['client_id']]);
        $trotOrders = $stmt->fetchAll();

        // Récupérer les commandes de pièces
        $stmt = $this->db->prepare("
            SELECT cp.*, COUNT(lp.IDPiece) as nb_items
            FROM cmdpiece cp
            LEFT JOIN lignecmdpiece lp ON cp.IDCmdPiece = lp.IDCmdPiece
            WHERE cp.IDClient = :clientId
            GROUP BY cp.IDCmdPiece
            ORDER BY cp.Date DESC
        ");
        $stmt->execute([':clientId' => $_SESSION['client_id']]);
        $pieceOrders = $stmt->fetchAll();

        // Combiner les résultats
        $allOrders = [
            'trottinettes' => $trotOrders,
            'pieces' => $pieceOrders
        ];

        echo json_encode(['success' => true, 'data' => $allOrders]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()]);
    }
}
}

// Gestion des routes
/*$action = $_GET['action'] ?? '';
$controller = new CmdtrotController();

switch ($action) {
    case 'addToCart':
        $controller->addToCart();
        break;
    case 'createOrder':
        $controller->createOrder();
        break;
    case 'getOrders':
        $controller->getClientOrders();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
        break;
}*/
?>