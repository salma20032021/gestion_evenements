<?php
require_once '../config/Database.php';

class EventModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function ajouterEvenement($titre, $date, $description) {
        $sql = "INSERT INTO events (titre, date_evenement, description) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$titre, $date, $description]);
    }

    public function getAllEvents() {
        $stmt = $this->conn->query("SELECT * FROM events ORDER BY date_evenement ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


