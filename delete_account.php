<?php
session_start();
$conn = new mysqli("localhost", "användare", "starkt_lösenord", "cloudstorage");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$conn->query("DELETE FROM users WHERE username = '$username'");

function deleteFolder($folder) {
    if (!is_dir($folder)) return;
    foreach (scandir($folder) as $item) {
        if ($item != "." && $item != "..") {
            $path = "$folder/$item";
            is_dir($path) ? deleteFolder($path) : unlink($path);
        }
    }
    rmdir($folder);
}
deleteFolder("/var/www/bchwebbdesign.se/public/uploads/$username");

session_destroy();
header("Location: register.php");
?>
