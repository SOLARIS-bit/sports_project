<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Gestion Sportive</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        .menu {
            margin-top: 40px;
        }
        .menu a {
            display: inline-block;
            margin: 15px;
            padding: 12px 24px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.2s ease-in-out;
        }
        .menu a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>🏟️ Tableau de bord - Projet de Gestion Sportive</h1>
    <div class="menu">
        <a href="insert_player.php">➕ Ajouter un joueur</a>
        <a href="view_players.php">👥 Voir les joueurs</a>
        <a href="insert_match.php">📅 Ajouter un match</a>
        <!-- Les liens suivants seront actifs après création -->
        <a href="match_summary.php">📊 Résumé d’un match</a>
        <a href="group_standings.php">🏆 Classement de groupe</a>
        <a href="top_scorers.php">🎯 Top buteurs</a>
        <a href="search_player.php">🔍 Rechercher un joueur</a>
        <a href="view_matches.php">📋 Voir les matchs</a>
        <a href="insert_goal_card.php">⚽ Ajouter but / carton</a>


    </div>
</body>
</html>
