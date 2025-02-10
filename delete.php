<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$file = basename($_POST["file"]);
$file_path = "/var/www/bchwebbdesign.se/public/uploads/$username/$file";

if (file_exists($file_path)) {
    unlink($file_path);
}
header("Location: dashboard.php");
?>
