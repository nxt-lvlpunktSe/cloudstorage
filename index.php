<?php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Molnlagring</title>
</head>
<body>
    <h2>Välkommen till din egen molnlagring!</h2>
    <a href="register.php">Registrera dig</a> | <a href="login.php">Logga in</a>
</body>
</html>
