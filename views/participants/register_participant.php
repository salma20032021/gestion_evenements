<?php
$message = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=gestion_evenements", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Récupérer uniquement les événements avec un titre non vide
    $events = $conn->query("SELECT id, titre FROM events WHERE titre IS NOT NULL AND titre != ''")->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['inscrire'])) {
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $event_id = $_POST['event_id'];

        if ($nom === '' || $email === '' || $event_id === '') {
            $message = "<p style='color:red;'>⚠️ Tous les champs sont obligatoires.</p>";
        } else {
            // Vérifier que l'événement existe toujours (n'a pas été supprimé)
            $stmt_check = $conn->prepare("SELECT id FROM events WHERE id = ? AND titre IS NOT NULL AND titre != ''");
            $stmt_check->execute([$event_id]);
            $event_exists = $stmt_check->fetch();

            if (!$event_exists) {
                $message = "<p style='color:red;'>❌ L'événement sélectionné n'existe plus ou est invalide.</p>";
            } else {
                $stmt1 = $conn->prepare("INSERT INTO participants (nom, email) VALUES (?, ?)");
                $stmt1->execute([$nom, $email]);
                $participant_id = $conn->lastInsertId();

                $stmt2 = $conn->prepare("INSERT INTO inscriptions (event_id, participant_id, date_inscription) VALUES (?, ?, NOW())");
                $stmt2->execute([$event_id, $participant_id]);

                $message = "<p style='color:green;'>✅ Participant inscrit avec succès !</p>";
                $_POST = []; // Réinitialise les champs
            }
        }
    }
} catch (PDOException $e) {
    $message = "<p style='color:red;'>❌ Erreur : " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscrire un participant</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #ffe082, #ffccbc);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }

        h2 {
            color: #ef6c00;
            margin-bottom: 20px;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 500px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #ef6c00;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #e65100;
        }

        .back-btn {
            margin-bottom: 25px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }

        .message {
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <a class="back-btn" href="../index.php">⬅ Retour à l'accueil</a>
    <h2>Inscrire un participant</h2>

    <?= $message ?>

    <form method="post" action="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

        <label for="event_id">Événement :</label>
        <select name="event_id" id="event_id" required>
            <option value="">-- Choisir un événement --</option>
            <?php foreach ($events as $event): ?>
                <option value="<?= $event['id'] ?>" <?= isset($_POST['event_id']) && $_POST['event_id'] == $event['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($event['titre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="inscrire" value="Inscrire">
    </form>

</body>
</html>