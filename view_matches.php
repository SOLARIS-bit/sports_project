<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si nécessaire
$dbname = "sports_management";

// Connexion à la base
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération des matchs
$sql = "
SELECT 
    m.date_time, m.venue,
    g.name AS group_name,
    t1.name AS team1,
    t2.name AS team2,
    r.name AS referee
FROM `Match` m
JOIN `Group` g ON m.group_id = g.group_id
JOIN Team t1 ON m.team1_id = t1.team_id
JOIN Team t2 ON m.team2_id = t2.team_id
JOIN Referee r ON m.referee_id = r.referee_id
ORDER BY m.date_time DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des matchs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>📅 Liste des matchs</h2>
    <table>
        <tr>
            <th>Date & Heure</th>
            <th>Lieu</th>
            <th>Groupe</th>
            <th>Équipe 1</th>
            <th>Équipe 2</th>
            <th>Arbitre</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['date_time'] ?></td>
                    <td><?= $row['venue'] ?></td>
                    <td><?= $row['group_name'] ?></td>
                    <td><?= $row['team1'] ?></td>
                    <td><?= $row['team2'] ?></td>
                    <td><?= $row['referee'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">Aucun match trouvé.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
