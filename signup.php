<?php
require('config.php');

if (isset($_POST["signup"])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    echo $password;
    $date = $_POST['date'];
    $query = "INSERT INTO `users`(`name`, `password`, `created_at`) VALUES ('$name', '$password', '$date')";


    if ($stmt = $conn->prepare('SELECT name from `users` where name=?')) {
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            header("location:signup.php?message?Username exists!");
        } else {
            if (mysqli_query($conn, $query)) {
                header("location:home.php?message=Account Created!");
            } else {
                header("location:signup.php?message?Something went wrong!");
            }
        }
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./css/style2.css">

    <!-- Bootstrap cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <?php
                            if ( isset($_GET["message"]) ) {
                                echo '
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Message!</strong> ' . $_GET["message"] . '
                                </div>
                                ';
                            }
                    ?>
                    <form method="POST" class="register-form" id="register-form" >
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                            <label for="date" style="margin-left: 300px;">Date</label>
                            <input type="date" name="date" id="date" autocomplete="off" required/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" autocomplete="off" required />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="./index.php" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>

    <script src="./js/main.js"></script>
</body>

</html>