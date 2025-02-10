<?php
session_start();
$conn = new mysqli("localhost", "användare", "starkt_lösenord", "cloudstorage");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Felaktigt användarnamn eller lösenord.";
    }
}
?>

<form method="post">
    Användarnamn: <input type="text" name="username" required><br>
    Lösenord: <input type="password" name="password" required><br>
    <input type="submit" value="Logga in">
</form>
