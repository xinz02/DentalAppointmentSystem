<?php
 
    include('config.php');

    // Create table
    $sql = "CREATE TABLE Comment (
        appointmentID INT(11) NOT NULL PRIMARY KEY,
        descriptions VARCHAR(7000),
        FOREIGN KEY (appointmentID) REFERENCES Appointment(appointmentID)
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "<br />Table Comment created";
    } else {   
        die('<br />Error creating table: ' . mysqli_connect_error());
    }
    
    mysqli_close($conn);
 

?>