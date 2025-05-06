<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si nécessaire
$dbname = "sports_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$message = "";

// Récupération des données nécessaires
$matches = $conn->query("
    SELECT m.match_id, t1.name AS team1, t2.name AS team2, m.date_time
    FROM `Match` m
    JOIN Team t1 ON m.team1_id = t1.team_id
    JOIN Team t2 ON m.team2_id = t2.team_id
");

$players = $conn->query("SELECT player_id, name FROM Player");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $match_id = intval($_POST["match_id"]);
    $player_id = intval($_POST["player_id"]);
    $minute = intval($_POST["minute"]);
    $action_type = $_POST["action_type"];

    // Récupère l’équipe du joueur
    $player_team = $conn->query("SELECT team_id FROM Player WHERE player_id = $player_id")->fetch_assoc();
    $team_id = $player_team["team_id"];

    if ($action_type === "goal") {
        $sql = "INSERT INTO Goal (match_id, player_id, team_id, minute_scored)
                VALUES ($match_id, $player_id, $team_id, $minute)";
        $message = $conn->query($sql) ? "✅ But ajouté !" : "❌ Erreur lors de l’ajout du but.";
    } elseif ($action_type === "card") {
        $card_type = $_POST["card_type"];
        $sql = "INSERT INTO Card (match_id, player_id, card_type, minute_given)
                VALUES ($match_id, $player_id, '$card_type', $minute)";
        $message = $conn->query($sql) ? "✅ Carton ajouté !" : "❌ Erreur lors de l’ajout du carton.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter but ou carton</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        label, select, input { display: block; margin: 10px 0; }
        .btn { margin-top: 20px; padding: 10px 20px; }
    </style>
    <script>
        function toggleCardType() {
            var action = document.getElementById("action_type").value;
            var cardTypeDiv = document.getElementById("card_type_div");
            cardTypeDiv.style.display = (action === "card") ? "block" : "none";
        }
    </script>
</head>
<body>
    <h2>➕ Ajouter un but ou un carton</h2>
    <?php if ($message): ?>
        <p><strong><?= $message ?></strong></p>
    <?php endif; ?>

    <form method="post">
        <label>Match :</label>
        <select name="match_id" required>
            <?php while($m = $matches->fetch_assoc()): ?>
                <option value="<?= $m["match_id"] ?>">
                    <?= $m["team1"] ?> vs <?= $m["team2"] ?> (<?= $m["date_time"] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Joueur :</label>
        <select name="player_id" required>
            <?php while($p = $players->fetch_assoc()): ?>
                <option value="<?= $p["player_id"] ?>"><?= $p["name"] ?></option>
            <?php endwhile; ?>
        </select>

        <label>Minute :</label>
        <input type="number" name="minute" required min="1" max="120">

        <label>Action :</label>
        <select name="action_type" id="action_type" onchange="toggleCardType()" required>
            <option value="goal">But</option>
            <option value="card">Carton</option>
        </select>

        <div id="card_type_div" style="display:none;">
            <label>Type de carton :</label>
            <select name="card_type">
                <option value="yellow">🟨 Jaune</option>
                <option value="red">🟥 Rouge</option>
            </select>
        </div>

        <button class="btn" type="submit">Ajouter</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
