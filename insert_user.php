<?php

    include('config.php');

    $hashpassword = md5($password);
    $sql = "INSERT INTO User(name, age, username, password, email, phone, gender, category) 
            VALUES ('$_POST[name]', '$_POST[age]', '$_POST[username]', '$hashpassword', '$_POST[email]', '$_POST[phone]', '$_POST[gender]', 1)";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("SQL query error encountered: " . mysqli_connect_error());
    }

    mysqli_close($conn);

?>