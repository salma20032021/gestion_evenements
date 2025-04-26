<?php
require_once __DIR__ . '/../config/Database.php';

class EventModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ajouterEvenement($titre, $date, $description) {
        try {
            $sql = "INSERT INTO events (titre, date_evenement, description) VALUES (:titre, :date_evenement, :description)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':date_evenement', $date);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Tu peux logger l’erreur ici si tu veux
            return false;
        }
    }

    public function getAllEvents() {
        try {
            $stmt = $this->conn->query("SELECT * FROM events ORDER BY date_evenement ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>


