<?php
    session_start();
    require("config.php");

    if (!isset($_SESSION['login'])) {
        header('location:index.php');
    }

    $name = $_SESSION['name'];

    $query = ("SELECT * FROM users WHERE name='$name'");
    $rows = mysqli_fetch_array(mysqli_query($conn, $query));
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

    <link rel="stylesheet" href="./css/style.css">

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

    <div class="container w-50">

        <div class="p-5 text-center bg-image pt-2" style="
      background-image: url('./uploads/<?php echo $rows['image_path']; ?>');
      height: 400px;
    ">
        </div>

        <form class="p-3 mt-5" method="POST" action="media.php" enctype="multipart/form-data">
            <input type="number" name="id" value="<?php echo $rows['id']; ?>" hidden>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="<?php echo $rows['name']; ?>" placeholder="Enter name" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $rows['password']; ?>" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="group2">You can also update your picture</label>
                <div class="input-group" id="group2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon2"><i class="far fa-file-image"></i></span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file2" aria-describedby="addon2" value="<?php echo $rows['image_path']; ?>" name="image">
                        <label class="custom-file-label" for="file2">Choose file</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info" name="update">Update</button>
            <input type="button" onclick="
            if (confirm('Are you sure you want to delete your account')) {
                window.location.href = 'delete.php'
            }
        " class="btn btn-danger" value="Delete your account">
        </form>
    </div>
</body>

</html>