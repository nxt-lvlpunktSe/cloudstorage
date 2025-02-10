<?php
session_start();
$conn = new mysqli("localhost", "användare", "starkt_lösenord", "cloudstorage");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        mkdir("/var/www/bchwebbdesign.se/public/uploads/$username", 0777, true);
        header("Location: login.php");
    } else {
        echo "Användarnamn upptaget.";
    }
}
?>
<form method="post">
    Användarnamn: <input type="text" name="username" required><br>
    Lösenord: <input type="password" name="password" required><br>
    <input type="submit" value="Registrera">
</form>
