<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si nécessaire
$dbname = "sports_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$results = [];
$keyword = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["keyword"])) {
    $keyword = $conn->real_escape_string($_POST["keyword"]);
    $sql = "
        SELECT p.name, p.birth_date, p.position, t.name AS team
        FROM Player p
        JOIN Team t ON p.team_id = t.team_id
        WHERE p.name LIKE '%$keyword%' OR p.position LIKE '%$keyword%'
    ";
    $results = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher un joueur</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #6c757d; color: white; }
        input[type="text"] {
            width: 300px;
            padding: 8px;
        }
        .btn {
            padding: 8px 16px;
        }
    </style>
</head>
<body>
    <h2>🔍 Rechercher un joueur</h2>
    <form method="post">
        <input type="text" name="keyword" placeholder="Nom ou poste..." value="<?= htmlspecialchars($keyword) ?>" required>
        <button class="btn" type="submit">Rechercher</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <h3>Résultats :</h3>
        <?php if ($results && $results->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Poste</th>
                    <th>Équipe</th>
                </tr>
                <?php while($row = $results->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row["birth_date"] ?></td>
                        <td><?= $row["position"] ?></td>
                        <td><?= $row["team"] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Aucun joueur trouvé.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
