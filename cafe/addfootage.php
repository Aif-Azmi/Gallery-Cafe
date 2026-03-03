<?php
if(isset($_POST['submit'])){
    $con = new mysqli('localhost', 'root', '', 'gallery');

    if($con->connect_error){
        die("Connection failed: " . $con->connect_error);
    }

    $targetDir = "uploads/";
    $footage = basename($_FILES["footage"]["name"]);
    $targetFilePath = $targetDir . $footage;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','mp4');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["footage"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $con->query("INSERT INTO your_table_name (footage) VALUES ('$footage')");
            if($insert){
                echo "The file ".$footage. " has been uploaded successfully.";
            }else{
                echo "File upload failed, please try again.";
            } 
        }else{
            echo "Sorry, there was an error uploading your file.";
        }
    }else{
        echo "Sorry, only JPG, JPEG, PNG, GIF, & MP4 files are allowed to upload.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Footage</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .upload-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .upload-container h2 {
            margin-bottom: 20px;
        }
        .file-input {
            display: none;
        }
        .file-label {
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .file-label:hover {
            background: #0056b3;
        }
        .upload-container button {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .upload-container button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload Footage</h2>
        <form action="addfootage.php" method="post" enctype="multipart/form-data">
            <input type="file" name="footage" id="footage" class="file-input" required>
            <label for="footage" class="file-label">Choose File</label>
            <button type="submit" name="submit">Upload</button>
        </form>
    </div>
</body>
</html>
