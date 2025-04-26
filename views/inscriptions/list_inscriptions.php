<?php
$inscriptions = [];

try {
    $conn = new PDO("mysql:host=localhost;dbname=gestion_evenements", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT p.nom, p.email, e.titre, i.date_inscription
            FROM inscriptions i
            JOIN participants p ON i.participant_id = p.id
            JOIN events e ON i.event_id = e.id
            ORDER BY i.date_inscription DESC";

    $stmt = $conn->query($sql);
    $inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📋 Liste des Inscriptions</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #fce4ec, #e3f2fd);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .back-btn {
            margin-bottom: 30px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            max-width: 800px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #7e57c2;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .empty-msg {
            color: #c0392b;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>📋 Liste des inscriptions</h2>
    <a class="back-btn" href="../index.php">⬅ Retour à l'accueil</a>

    <?php if (count($inscriptions) > 0): ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Événement</th>
                <th>Date d'inscription</th>
            </tr>
            <?php foreach ($inscriptions as $ins): ?>
            <tr>
                <td><?= htmlspecialchars($ins['nom']) ?></td>
                <td><?= htmlspecialchars($ins['email']) ?></td>
                <td><?= htmlspecialchars($ins['titre']) ?></td>
                <td><?= htmlspecialchars($ins['date_inscription']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p class="empty-msg">Aucune inscription trouvée.</p>
    <?php endif; ?>

</body>
</html>
