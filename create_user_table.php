<?php
 
	  include('config.php');


        //Create table
        $sql = "CREATE TABLE User (
            userID INT(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            age INT(2),
            username VARCHAR(12) NOT NULL,
            password VARCHAR(35),
            email VARCHAR(30) NOT NULL,
            phone VARCHAR(12) NOT NULL,
            gender VARCHAR(1) NOT NULL,
            category INT(1)
        )";
            

        if (mysqli_query($conn, $sql)) {
            echo "<br />Table User created";
        }

        else {   
            die('<br />Error creating table: ' . mysqli_connect_error());
        }

        mysqli_close($conn);

?>