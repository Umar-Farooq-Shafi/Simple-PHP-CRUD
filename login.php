<?php
    require("config.php");
    session_start();

    if ( isset($_POST["login"]) ) {
        $query = $conn->prepare("SELECT `id`, `name`, `password`, `image_path`, `created_at`, `attempts`, `lock_account` FROM `users` WHERE name = ?");
        echo $_POST["name"];
        $query->bind_param('s', $_POST['name']);
        $query->execute();
        $query->store_result();

        if ( $query->num_rows >= 0 ) {
            $query->bind_result($id, $name, $password, $image_path, $created_at, $attempts, $lock_account);
            $query->fetch();

            if ( $_POST['password'] == $password && $lock_account != 1 ) {
                session_regenerate_id();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['password'] = $password;
                $_SESSION['image_path'] = $image_path;
                $_SESSION['created_at'] = $created_at;

                header("Location:home.php?message=Successfully login");
            } else if ($lock_account == 1) {
                header("location:index.php?message=Too many attempts!");
            } else {
                if ($attempts == 5) {
                    mysqli_query($conn, "UPDATE `users` SET `lock_account`= '1' WHERE id = '$id'");
                    header("location:index.php?message=Account Locked!");
                }else {
                    $attempts = $attempts + 1;
                    mysqli_query($conn, "UPDATE `users` SET `attempts` = '$attempts' WHERE id = '$id'");
                }
                header("location:index.php?message=Password or Username incorrect");
            }
            $query->close();
        } else {
            header("location:index.php?message=Password or Username incorrect!");
        }
    }
