<?php

include("config.php");

    $pass = md5('chiang512');
    $sql = "INSERT INTO Dentist(name, username, password, specialization, email, phone, gender, category) VALUES ('Kenny Chiang', 'chiang512', '$pass', 'General', 'kenny512@gmail.com', '0187739514', 'M', 2)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);//excute query insert into table user

    $pass = md5('rozmil33');
    $sql = "INSERT INTO Dentist(name, username, password, specialization, email, phone, gender, category) VALUES ('Roziana binti Kamil', 'rozmil33', '$pass', 'General', 'rozmil@gmail.com', '0123547667', 'F', 2)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);

    $pass = md5('joan123');
    $sql = "INSERT INTO Dentist(name, username, password, specialization, email, phone, gender, category) VALUES ('Joanne Leow', 'joan123', '$pass', 'Braces and Implants', 'joannne05@hotmail.com', '0163380514', 'F', 2)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);

    $pass = md5('yang912');
    $sql = "INSERT INTO Dentist(name, username, password, specialization, email, phone, gender, category) VALUES ('Yang Chin Peng', 'yang912', '$pass', 'Root Canal', 'chinp0912@gmail.com', '0179853214', 'M', 2)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);

    $pass = md5('kandiah08');
    $sql = "INSERT INTO Dentist(name, username, password, specialization, email, phone, gender, category) VALUES ('Kandiah Ganpati a/l Dharmalingam', 'kandiah08', '$pass', 'Dental X-Rays', 'kandiah753@yahoo.com', '0137735914', 'M', 2)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);

    $pass = md5('amy123456');
    $sql = "INSERT INTO User(name, age, username, password, email, phone, gender, category) VALUES ('Amy Tan', 25, 'amytan', '$pass', 'amytan@yahoo.com', '0193874517', 'F', 1)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);

    $pass = md5('ali123456');
    $sql = "INSERT INTO User(name, age, username, password, email, phone, gender, category) VALUES ('Ali bin Abu', 31, 'ali123', '$pass', 'ali@gmail.com', '0113377541', 'M', 1)";  //select * from user where username='me' and password=md5($mypass)
    $query = mysqli_query($conn, $sql);

    if (!$query) die("SQL query error encountered: ".mysqli_connect_error()); 
    mysqli_close($conn);



?>