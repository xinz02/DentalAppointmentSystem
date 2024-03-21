<?php

    $conn = mysqli_connect("localhost", "wpproject", "wp123");

    if(!$conn) die ("Error! Cannot connect to the server: " . mysqli_connect_error());

    $db = mysqli_select_db($conn, "wpproject");

    if(!$db) die ("Cannot use database: " . mysqli_connect_error());

?>