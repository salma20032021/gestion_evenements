<?php
require_once __DIR__ . '/../models/EventModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    // Sécurisation des données avec trim() et htmlspecialchars()
    $titre = isset($_POST['titre']) ? htmlspecialchars(trim($_POST['titre'])) : '';
    $date = isset($_POST['date_evenement']) ? htmlspecialchars(trim($_POST['date_evenement'])) : '';
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';

    if (!empty($titre) && !empty($date) && !empty($description)) {
        $eventModel = new EventModel();
        $eventModel->ajouterEvenement($titre, $date, $description);

        // Redirection avec message de succès
        header('Location: ../views/events/create_event.php?success=1');
        exit;
    } else {
        // Redirection avec message d'erreur si champs vides
        header('Location: ../views/events/create_event.php?error=1');
        exit;
    }
}
?>



