<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $success = "File uploaded successfully.";
        } else {
            $error = "File upload failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Upload Notes</title>
</head>
<body>
    <div class="container">
        <h1>Upload Class Notes</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Upload</button>
        </form>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <a href="download.php">View Uploaded Files</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>