<?php

class Commentaire {
    private $contenu;
    private $internaute_id;

    public function __construct($contenu, $internaute_id) {
        $this->contenu = $contenu;
        $this->internaute_id = $internaute_id;
    }

    public function ajouter($pdo) {
        $sql = "INSERT INTO commentaire (contenu, date_commentaire, internaute_id)
                VALUES (:contenu, NOW(), :internaute_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':contenu' => $this->contenu,
            ':internaute_id' => $this->internaute_id
        ]);
    }

    public static function getCommentairesUniques($pdo) {
        $sql = "SELECT c.*, i.email 
                FROM commentaire c
                INNER JOIN (
                    SELECT internaute_id, MAX(date_commentaire) AS max_date
                    FROM commentaire
                    GROUP BY internaute_id
                ) latest ON c.internaute_id = latest.internaute_id AND c.date_commentaire = latest.max_date
                JOIN internaute i ON c.internaute_id = i.id
                ORDER BY c.date_commentaire DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
