<?php
 
	  include('config.php');


        //Create table
        $sql = "CREATE TABLE Dentist (
            dentistID INT(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            username VARCHAR(12) NOT NULL,
            password VARCHAR(35) NOT NULL,
            specialization VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            phone VARCHAR(20) NOT NULL,
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