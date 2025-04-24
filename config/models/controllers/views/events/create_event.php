<?php
if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $date = $_POST['date_evenement'];
    $description = $_POST['description'];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=gestion_evenements", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO events (titre, date_evenement, description) VALUES (?, ?, ?)");
        $stmt->execute([$titre, $date, $description]);

        echo "<p style='color:green;'>✅ Événement ajouté avec succès !</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>❌ Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un événement</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #c8e6c9, #b3e5fc);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }

        h2 {
            color: #2e7d32;
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

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #2e7d32;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #1b5e20;
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
    </style>
</head>
<body>

    <a class="back-btn" href="index.php">⬅ Retour à l'accueil</a>
    <h2>Créer un événement</h2>

    <form method="post" action="">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required>

        <label for="date_evenement">Date :</label>
        <input type="date" name="date_evenement" id="date_evenement" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="4"></textarea>

        <input type="submit" name="ajouter" value="Créer">
    </form>

</body>
</html>




