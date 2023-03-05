<?php
    $servername = "sdb-58.hosting.stackcp.net";
    $username = "matt1234-3530313728fe";
    $password = "3z6ew0lh6u";
    $dbname = "matt1234-3530313728fe";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }