<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Define allowed file types and max file size (2MB)
    $allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2 MB

    // Check if file is uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];

        // Validate file type
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Error: Only PNG, JPG, and GIF files are allowed.";
            exit;
        }

        // Validate file size
        if ($file['size'] > $maxFileSize) {
            echo "Error: File size exceeds the 2 MB limit.";
            exit;
        }

        // Set upload directory and move file
        $uploadDir = 'uploads/';

        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $destination = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo "Success: File uploaded successfully!";
        } else {
            echo "Error: Failed to upload the file.";
        }
    } else {
        echo "Error: No file uploaded or an error occurred.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Choose a file to upload (PNG, JPG, GIF):</label><br>
        <input type="file" name="file" id="file" required><br><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
