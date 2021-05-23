<?php
    session_start();
    require("config.php");

    $name = $_SESSION['name'];

    if( !isset($_SESSION['login']) ) {
        header('location:index.php?message=session expire');
    }

    $query = "DELETE FROM users where name='$name'";
    
    if(! mysqli_query($conn, $query) ) {
        die("Something went wrong!");    
    }
    
    header('location:index.php?message=deleted successfully');
?>