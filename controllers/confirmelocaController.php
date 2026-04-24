<?php 
session_start();
require_once "../controllers/ReservationController.php"; 

 $reservation= new ReservationController();
        $idtrotinette = $_POST['idtrotinette'] ?? null;
        $datereservation = $_POST['datereservation'] ?? null;
        $datedebut = $_POST['datedebut'] ?? null;
        $datefin = $_POST['datefin'] ?? null;
        $tarif = $_POST['tarif'] ?? null;
        $total = $_POST['total'] ?? null;
    $result=$reservation->create($idtrotinette,$datereservation,$datedebut,$datefin,$tarif,$total);



require_once '../views/html/confirmationloca.php';
?>