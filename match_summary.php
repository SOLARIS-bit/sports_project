<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si besoin
$dbname = "sports_management";

// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$matches = $conn->query("
    SELECT m.match_id, t1.name AS team1, t2.name AS team2, m.date_time
    FROM `Match` m
    JOIN Team t1 ON m.team1_id = t1.team_id
    JOIN Team t2 ON m.team2_id = t2.team_id
    ORDER BY m.date_time DESC
");

$summary = null;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["match_id"])) {
    $match_id = intval($_POST["match_id"]);

    $summary = [];

    // Infos match
    $match_info = $conn->query("
        SELECT m.match_id, m.date_time, m.venue,
               t1.name AS team1, t2.name AS team2
        FROM `Match` m
        JOIN Team t1 ON m.team1_id = t1.team_id
        JOIN Team t2 ON m.team2_id = t2.team_id
        WHERE m.match_id = $match_id
    ")->fetch_assoc();

    // Buts
    $goals = $conn->query("
        SELECT p.name AS player, t.name AS team, g.minute_scored
        FROM Goal g
        JOIN Player p ON g.player_id = p.player_id
        JOIN Team t ON g.team_id = t.team_id
        WHERE g.match_id = $match_id
        ORDER BY g.minute_scored
    ");

    // Cartons
    $cards = $conn->query("
        SELECT p.name AS player, t.name AS team, c.card_type, c.minute_given
        FROM Card c
        JOIN Player p ON c.player_id = p.player_id
        JOIN Team t ON p.team_id = t.team_id
        WHERE c.match_id = $match_id
        ORDER BY c.minute_given
    ");

    $summary = [
        "match" => $match_info,
        "goals" => $goals,
        "cards" => $cards
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résumé de match</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        h2 { text-align: center; }
        label, select, button { margin: 10px 0; display: block; }
        .section { margin-top: 30px; }
        .section h3 { border-bottom: 1px solid #ccc; }
    </style>
</head>
<body>
    <h2>📊 Résumé d’un match</h2>
    <form method="post">
        <label for="match_id">Sélectionner un match :</label>
        <select name="match_id" required>
            <?php while($m = $matches->fetch_assoc()): ?>
                <option value="<?= $m['match_id'] ?>">
                    <?= $m['team1'] ?> vs <?= $m['team2'] ?> (<?= $m['date_time'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Afficher le résumé</button>
    </form>

    <?php if ($summary): ?>
        <div class="section">
            <h3>📅 Match</h3>
            <p><strong><?= $summary["match"]["team1"] ?> vs <?= $summary["match"]["team2"] ?></strong></p>
            <p>Date : <?= $summary["match"]["date_time"] ?> | Lieu : <?= $summary["match"]["venue"] ?></p>
        </div>

        <div class="section">
            <h3>⚽ Buts</h3>
            <?php if ($summary["goals"]->num_rows > 0): ?>
                <ul>
                    <?php while($g = $summary["goals"]->fetch_assoc()): ?>
                        <li><?= $g["team"] ?> - <?= $g["player"] ?> (<?= $g["minute_scored"] ?>’)</li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Aucun but</p>
            <?php endif; ?>
        </div>

        <div class="section">
            <h3>🟨🟥 Cartons</h3>
            <?php if ($summary["cards"]->num_rows > 0): ?>
                <ul>
                    <?php while($c = $summary["cards"]->fetch_assoc()): ?>
                        <li><?= $c["team"] ?> - <?= $c["player"] ?> : <?= $c["card_type"] ?> (<?= $c["minute_given"] ?>’)</li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Aucun carton</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
