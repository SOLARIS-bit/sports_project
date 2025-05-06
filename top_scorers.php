<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si nécessaire
$dbname = "sports_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Requête pour récupérer les meilleurs buteurs
$sql = "
SELECT 
    p.name AS player,
    t.name AS team,
    COUNT(g.goal_id) AS goals
FROM Goal g
JOIN Player p ON g.player_id = p.player_id
JOIN Team t ON g.team_id = t.team_id
GROUP BY g.player_id
ORDER BY goals DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Top Buteurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f7f7f7;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 60%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>🏆 Top Buteurs</h2>
    <table>
        <tr>
            <th>Joueur</th>
            <th>Équipe</th>
            <th>Buts</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["player"] ?></td>
                    <td><?= $row["team"] ?></td>
                    <td><?= $row["goals"] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3">Aucun buteur enregistré</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
