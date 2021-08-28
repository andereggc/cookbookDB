<?php

    // connect to database
    $conn = mysqli_connect('localhost', 'Cam', 'password123', 'camsCookbook');

    // checks connection
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>