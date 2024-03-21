<?php
 
	  include('config.php');


        //Create table
        $sql = "CREATE TABLE Appointment (
            appointmentID INT(11) AUTO_INCREMENT PRIMARY KEY,
            userID INT(11) NOT NULL,
            dentistID INT(11) NOT NULL,
            appointmentDate VARCHAR(12) NOT NULL,
            appointmentTime VARCHAR(10) NOT NULL,
            appointment_category VARCHAR(50),
            FOREIGN KEY (userID) REFERENCES User(userID),
            FOREIGN KEY (dentistID) REFERENCES Dentist(dentistID)
        )";
        
        
        if (mysqli_query($conn, $sql)) {
            echo "<br />Table User created";
        }

        else {   
            die('<br />Error creating table: ' . mysqli_connect_error());
        }

        mysqli_close($conn);

?>