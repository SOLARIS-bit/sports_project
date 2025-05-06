<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si nécessaire
$dbname = "sports_management";

// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération des données nécessaires pour les menus déroulants
$teams = $conn->query("SELECT team_id, name FROM Team");
$referees = $conn->query("SELECT referee_id, name FROM Referee");
$groups = $conn->query("SELECT group_id, name FROM `Group`");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_time = $_POST['date_time'];
    $venue = $_POST['venue'];
    $group_id = intval($_POST['group_id']);
    $referee_id = intval($_POST['referee_id']);
    $team1_id = intval($_POST['team1_id']);
    $team2_id = intval($_POST['team2_id']);

    if ($team1_id === $team2_id) {
        $message = "❌ Les deux équipes doivent être différentes.";
    } else {
        $sql = "INSERT INTO `Match` (date_time, venue, group_id, referee_id, team1_id, team2_id)
                VALUES ('$date_time', '$venue', $group_id, $referee_id, $team1_id, $team2_id)";
        if ($conn->query($sql) === TRUE) {
            $message = "✅ Match ajouté avec succès.";
        } else {
            $message = "❌ Erreur : " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un match</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        label {
            display: block;
            margin-top: 12px;
        }
        input, select {
            padding: 6px;
            width: 300px;
        }
        .btn {
            margin-top: 16px;
            padding: 10px 20px;
        }
        .message {
            margin-top: 16px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <h2>➕ Ajouter un match</h2>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="post">
        <label for="date_time">Date et heure :</label>
        <input type="datetime-local" name="date_time" required>

        <label for="venue">Lieu :</label>
        <input type="text" name="venue" required>

        <label for="group_id">Groupe :</label>
        <select name="group_id" required>
            <?php while($g = $groups->fetch_assoc()): ?>
                <option value="<?= $g['group_id'] ?>"><?= $g['name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="referee_id">Arbitre :</label>
        <select name="referee_id" required>
            <?php while($r = $referees->fetch_assoc()): ?>
                <option value="<?= $r['referee_id'] ?>"><?= $r['name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="team1_id">Équipe 1 :</label>
        <select name="team1_id" required>
            <?php while($t = $teams->fetch_assoc()): ?>
                <option value="<?= $t['team_id'] ?>"><?= $t['name'] ?></option>
            <?php endwhile; ?>
        </select>

        <?php 
        // Recharge les équipes une deuxième fois pour team2
        $teams2 = $conn->query("SELECT team_id, name FROM Team");
        ?>

        <label for="team2_id">Équipe 2 :</label>
        <select name="team2_id" required>
            <?php while($t2 = $teams2->fetch_assoc()): ?>
                <option value="<?= $t2['team_id'] ?>"><?= $t2['name'] ?></option>
            <?php endwhile; ?>
        </select>

        <br>
        <button class="btn" type="submit">Ajouter le match</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
