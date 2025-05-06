<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si nécessaire
$dbname = "sports_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$groups = $conn->query("SELECT group_id, name FROM `Group`");
$standings = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["group_id"])) {
    $group_id = intval($_POST["group_id"]);

    // Récupérer toutes les équipes du groupe
    $teams = $conn->query("
        SELECT t.team_id, t.name FROM Team t
        JOIN Team_Group tg ON t.team_id = tg.team_id
        WHERE tg.group_id = $group_id
    ");

    while ($team = $teams->fetch_assoc()) {
        $team_id = $team["team_id"];
        $name = $team["name"];

        // Matchs joués comme team1
        $stats1 = $conn->query("
            SELECT m.match_id,
                (SELECT COUNT(*) FROM Goal WHERE match_id = m.match_id AND team_id = m.team1_id) AS goals_for,
                (SELECT COUNT(*) FROM Goal WHERE match_id = m.match_id AND team_id = m.team2_id) AS goals_against
            FROM `Match` m
            WHERE m.group_id = $group_id AND m.team1_id = $team_id
        ");

        // Matchs joués comme team2
        $stats2 = $conn->query("
            SELECT m.match_id,
                (SELECT COUNT(*) FROM Goal WHERE match_id = m.match_id AND team_id = m.team2_id) AS goals_for,
                (SELECT COUNT(*) FROM Goal WHERE match_id = m.match_id AND team_id = m.team1_id) AS goals_against
            FROM `Match` m
            WHERE m.group_id = $group_id AND m.team2_id = $team_id
        ");

        $played = 0;
        $won = 0;
        $lost = 0;
        $drawn = 0;
        $gf = 0;
        $ga = 0;

        while ($row = $stats1->fetch_assoc()) {
            $played++;
            $gf += $row["goals_for"];
            $ga += $row["goals_against"];
            if ($row["goals_for"] > $row["goals_against"]) $won++;
            elseif ($row["goals_for"] < $row["goals_against"]) $lost++;
            else $drawn++;
        }

        while ($row = $stats2->fetch_assoc()) {
            $played++;
            $gf += $row["goals_for"];
            $ga += $row["goals_against"];
            if ($row["goals_for"] > $row["goals_against"]) $won++;
            elseif ($row["goals_for"] < $row["goals_against"]) $lost++;
            else $drawn++;
        }

        $points = $won * 3 + $drawn;

        $standings[] = [
            "team" => $name,
            "played" => $played,
            "won" => $won,
            "drawn" => $drawn,
            "lost" => $lost,
            "gf" => $gf,
            "ga" => $ga,
            "points" => $points
        ];
    }

    // Tri par points décroissants puis différence de buts
    usort($standings, function($a, $b) {
        if ($b["points"] === $a["points"]) {
            return ($b["gf"] - $b["ga"]) - ($a["gf"] - $a["ga"]);
        }
        return $b["points"] - $a["points"];
    });
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement de groupe</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #ffc107;
        }
    </style>
</head>
<body>
    <h2>🏆 Classement d’un groupe</h2>
    <form method="post">
        <label for="group_id">Sélectionner un groupe :</label>
        <select name="group_id" required>
            <?php while($g = $groups->fetch_assoc()): ?>
                <option value="<?= $g["group_id"] ?>"><?= $g["name"] ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Voir classement</button>
    </form>

    <?php if (!empty($standings)): ?>
        <table>
            <tr>
                <th>Équipe</th>
                <th>MJ</th>
                <th>V</th>
                <th>N</th>
                <th>D</th>
                <th>BP</th>
                <th>BC</th>
                <th>Pts</th>
            </tr>
            <?php foreach ($standings as $s): ?>
                <tr>
                    <td><?= $s["team"] ?></td>
                    <td><?= $s["played"] ?></td>
                    <td><?= $s["won"] ?></td>
                    <td><?= $s["drawn"] ?></td>
                    <td><?= $s["lost"] ?></td>
                    <td><?= $s["gf"] ?></td>
                    <td><?= $s["ga"] ?></td>
                    <td><?= $s["points"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>
