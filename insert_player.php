<?php
$servername = "localhost";
$username = "webuser";
$password = "webpass"; // Mets ton mot de passe MariaDB si défini
$dbname = "sports_management"; // Remplace par le nom de ta base

// Connexion à la base
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birth = $_POST['birth_date'];
    $position = $_POST['position'];
    $team_id = intval($_POST['team_id']);

    $sql = "INSERT INTO Player (name, birth_date, position, team_id)
            VALUES ('$name', '$birth', '$position', '$team_id')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Joueur ajouté avec succès.";
    } else {
        echo "❌ Erreur : " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head><title>Ajouter un joueur</title></head>
<body>
<h2>Ajouter un joueur</h2>
<form method="post" action="">
    Nom : <input type="text" name="name" required><br>
    Date de naissance : <input type="date" name="birth_date" required><br>
    Poste : <input type="text" name="position" required><br>
    ID Équipe : <input type="number" name="team_id" required><br>
    <input type="submit" value="Ajouter">
</form>
</body>
</html>
