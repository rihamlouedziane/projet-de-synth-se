<?php

class ReservationModel {
    private $db;

    public function __construct() {
        $this->db = require __DIR__ . '/../config/database.php'; 
    }

    public function createReservation($idclient, $idtrotinette, $datereservation, $datedebut, $datefin, $tarif, $total, $etat) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO cmdloca 
                (idclient, idtrotinette, datereservation, datedebut, datefin, tarif, total, etat) 
                VALUES 
                (:idclient, :idtrotinette, :datereservation, :datedebut, :datefin, :tarif, :total, :etat)
            ");

            $stmt->bindParam(':idclient', $idclient);
            $stmt->bindParam(':idtrotinette', $idtrotinette);
            $stmt->bindParam(':datereservation', $datereservation);
            $stmt->bindParam(':datedebut', $datedebut);
            $stmt->bindParam(':datefin', $datefin);
            $stmt->bindParam(':tarif', $tarif);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':etat', $etat);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}