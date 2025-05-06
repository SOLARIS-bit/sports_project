<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe si tu en as un
$dbname = "sports_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Player");

echo "<h2>Liste des joueurs</h2>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Nom</th>
<th>Date de naissance</th>
<th>Poste</th>
<th>ID Équipe</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["player_id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["birth_date"] . "</td>";
    echo "<td>" . $row["position"] . "</td>";
    echo "<td>" . $row["team_id"] . "</td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
?>
