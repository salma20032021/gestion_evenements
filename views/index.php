<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>🎉 Gestion des Événements</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #2c3e50;
            font-size: 36px;
            margin-bottom: 40px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 20px 0;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #673ab7;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.2s;
            display: inline-block;
        }

        a:hover {
            background-color: #512da8;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1>🎉 Gestion des Événements</h1>
    <ul>
        <li>
            <a href="/gestion_evenements/views/events/create_event.php">Créer un événement</a>
        </li>
        <li>
            <a href="/gestion_evenements/views/participants/register_participant.php">Inscrire un participant</a>
        </li>
        <li>
            <a href="/gestion_evenements/views/inscriptions/list_inscriptions.php">Liste des inscriptions</a>
        </li>
    </ul>
</body>
</html>

