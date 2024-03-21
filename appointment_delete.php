<?php
include('config.php');

$selectedAppointment = $_GET['appointmentID'];

$sql = "DELETE FROM Appointment WHERE appointmentID = '$selectedAppointment'";

if(mysqli_query($conn, $sql)) {
    echo "<script>alert('Successfully deleted.');";
    
    header("Location: appointmentlist_user.php?userID='$selectedUser'");
}
?>
