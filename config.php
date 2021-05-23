<?php
    $conn = mysqli_connect("localhost", "root", "", "lab");

    if ( $conn === false ) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
