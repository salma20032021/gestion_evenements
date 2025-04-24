<?php
require_once '../models/EventModel.php';

if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $date = $_POST['date_evenement'];
    $description = $_POST['description'];

    $eventModel = new EventModel();
    $eventModel->ajouterEvenement($titre, $date, $description);

    // Redirection avec message de succès
    header('Location: ../views/events/create_event.php?success=1');
    exit;
}
?>


