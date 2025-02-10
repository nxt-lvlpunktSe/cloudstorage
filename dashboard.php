<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION["username"];
$upload_dir = "/var/www/bchwebbdesign.se/public/uploads/$username";
?>

<h2>Välkommen, <?php echo htmlspecialchars($username); ?></h2>
<a href="logout.php">Logga ut</a>

<h3>Ladda upp en fil</h3>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload">
    <input type="submit" value="Ladda upp">
</form>

<h3>Dina filer</h3>
<ul>
<?php
$files = array_diff(scandir($upload_dir), array('.', '..'));
foreach ($files as $file) {
    echo "<li>
        <a href='uploads/$username/$file'>$file</a>
        <form action='delete.php' method='post' style='display:inline;'>
            <input type='hidden' name='file' value='$file'>
            <input type='submit' value='Radera'>
        </form>
    </li>";
}
?>
</ul>

<h3>Radera konto</h3>
<form action="delete_account.php" method="post">
    <input type="submit" value="Radera mitt konto">
</form>
