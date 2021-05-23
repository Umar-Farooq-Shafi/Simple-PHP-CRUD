<?php
    session_start();
    require("config.php");

    if (! isset($_SESSION['login']) ) {
        header("location:index.php?message=You must login.");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <!-- Custom css -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- FONT cdn -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    
    <!-- Bootstrap cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="./home.php" class="navbar-brand">
            <img src="images/signup-image.jpg" height="28" alt="CoolBrand">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="./profile.php" class="nav-item nav-link">Profile</a>
            </div> |
            <div class="navbar-nav">
                <a href="./logout.php" class="nav-item nav-link">Logout</a>
            </div>
        </div>
    </nav>

    <div class="banner">
        <?php if (isset($_GET['message'])) {
            echo '
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Message!</strong> ' . $_GET["message"] . '
            </div>
            ';
        } ?>
        <h1>Main(Home) Page</h1><hr>
        <h2>Welcome <?php echo $_SESSION['name']; ?></h2>
    </div>
</body>

</html>