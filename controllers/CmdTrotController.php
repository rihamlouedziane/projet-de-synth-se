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
        $this->panierModel = new Panier(
            $_SESSION['client_id'],
            null,
            null,
            null,
            'actif'
        );
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['client_id'])) {
            echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter']);
            return false;
        }

        try {
            

            // 1. Créer la commande
            $stmt = $this->db->prepare("
                INSERT INTO cmdtrot (datecmd, idclient, idrespo, total) 
                VALUES (NOW(), :clientId, NULL, 0)
            ");
            $stmt->execute([':clientId' => $_SESSION['client_id']]);
            $idcmdtrot = $this->db->lastInsertId();

            // 2. Récupérer les articles du panier
            $items = $this->panierModel->getPanierByClient($this->db,$_SESSION['client_id']);
            $total = 0;

            // 3. Ajouter chaque article à la commande
            foreach ($items as $item) {
                if ($item['IDTrotinette']) { // C'est une trottinette
                    $stmt = $this->db->prepare("
                        INSERT INTO lignecmdtrot (idcmdtrot, idtrotinette, prix)
                        VALUES (:orderId, :trotId, :price)
                    ");
                    $stmt->execute([
                        ':orderId' => $idcmdtrot,
                        ':trotId' => $item['IDTrotinette'],
                        ':price' => $item['Tarif']
                    ]);

                   
                    $total += $item['Tarif'] * $item['Quantite'];
                }
            }

            // 4. Mettre à jour le total de la commande
            $stmt = $this->db->prepare("
                UPDATE cmdtrot 
                SET total = :total 
                WHERE idcmdtrot = :id
            ");
            $stmt->execute([
                ':total' => $total,
                ':id' => $idcmdtrot
            ]);

            // 5. Vider le panier
            $this->panierModel->viderPanier($this->db ,$_SESSION['client_id']);

          

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
            // Récupérer les commandes
            $stmt = $this->db->prepare("
                SELECT c.*, COUNT(l.idtrotinette) as nb_items 
                FROM cmdtrot c
                LEFT JOIN lignecmdtrot l ON c.idcmdtrot = l.idcmdtrot
                WHERE c.idclient = :clientId
                GROUP BY c.idcmdtrot
                ORDER BY c.datecmd DESC
            ");
            $stmt->execute([':clientId' => $_SESSION['client_id']]);
            $orders = $stmt->fetchAll();

            echo json_encode(['success' => true, 'data' => $orders]);

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