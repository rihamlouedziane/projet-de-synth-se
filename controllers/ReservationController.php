<?php
if(!isset($_SESSION['client_id'])) {
    session_start();
}
require_once '../models/ReservationModel.php';

class ReservationController {
    public function create($idtrotinette,$datereservation,$datedebut,$datefin,$tarif,$total):bool {
        // Check if user is logged in
        $receivedData = $_POST['data'] ?? null;
       
        
       
        if (!isset($_SESSION['client_id'])) {
            header('Location: ../views/auth/login.php');
        }
        
        // Validate and sanitize input
        $idclient = $_SESSION['client_id'];
        $etat = 'en attente'; // Default state

        // Validate all required fields
        if (!$idclient || !$idtrotinette || !$datereservation || !$datedebut || !$datefin || !$tarif || !$total) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            header('Location: ../views/reservation.php');
            return false;
        }

        // Create reservation model and save to database
        $reservationModel = new ReservationModel();
        $result = $reservationModel->createReservation(
            $idclient,
            $idtrotinette,
            $datereservation,
            $datedebut,
            $datefin,
            $tarif,
            $total,
            $etat
        );

        if ($result) {
            // Clear the selected product from localStorage (via JavaScript)
            $_SESSION['success'] = "Réservation confirmée avec succès!";
         //   header('Location: ../views/client/dashboard.php');
         return true;
        } else {
            $_SESSION['error'] = "Erreur lors de la réservation";
          //  header('Location: ../views/reservation.php');
            return false;
        }
    }
}

// Handle the action
$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new ReservationController();
if ($action == 'create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->create($idtrotinette,$datereservation,$datedebut,$datefin,$tarif,$total);
}