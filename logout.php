<?php
    session_start();
    session_destroy();

    header("location:index.php?message=logged out successfully!");
?>