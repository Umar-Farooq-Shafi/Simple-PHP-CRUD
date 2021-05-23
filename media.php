<?php
    session_start();
    require("config.php");

    if ( isset($_POST['update'] )) {
        $newName = $_POST['name'];
        $password = $_POST['password'];

        $id = $_SESSION['id'];

        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";

        $errors = []; // Store errors here

        $fileExtensionsAllowed = ['jpeg', 'jpg']; // These will be the only file extensions allowed

        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileName = explode('.', $fileName);
        $fileExtension = strtolower(end($fileName));
        $fileName = $_FILES['image']['name'];

        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

        if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a file";
        }

        if ($fileSize > 5000000) {
            $errors[] = "File exceeds maximum size (4MB)";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    
            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
              $timestamp = date('Y-m-d H:i:s');
              $path = basename($fileName);

              if ($newName == $_SESSION['name']) {
                    header("Location:home.php?message=You entered same name!");
                } else {
                    $query = "UPDATE `users` SET `name`='$newName', `password`='$password', `image_path`='$path', `created_at`='$timestamp' WHERE id = '$id'";
                    $res = mysqli_query($conn, $query);
        
                    if ($res) {
                        $_SESSION['name'] = $newName;
                        $_SESSION['password'] = $password;
                        $_SESSION['image_path'] = $path;
                        $_SESSION['created_at'] = $timestamp;
                        header("location:home.php?message=Profile updated");
                    } else {
                        die("Something went wrong!");
                    }
                }
            } else {
                die("An error occurred.");
            }
          } else {
            foreach ($errors as $error) {
                die($error . "These are the errors");
            }
        }
    }
