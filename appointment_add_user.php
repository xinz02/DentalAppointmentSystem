<?php
session_start();
include('config.php');

$selectedUser = $_GET['userID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDentist = $_POST['dentist'];
    $selectedDate = $_POST['date'];
    $selectedTime = $_POST['time'];

    $selectedValue = explode('|', $selectedDentist);
    $dentistID = $selectedValue[0];
    $specialization = $selectedValue[1];

    $formatDate = date('Y-m-d', strtotime($selectedDate));

    $existingApp = "SELECT * FROM appointment WHERE dentistID = '$dentistID' AND appointmentDate = '$formatDate' AND appointmentTime = '$selectedTime'";
    $checkExistingApp = mysqli_query($conn, $existingApp);

    $appStatus = "";

    if (mysqli_num_rows($checkExistingApp) > 0) {
        $appStatus = "The selected appointment slot is already booked, please select another slot";
        echo "<script>alert('$appStatus'); </script>";
    } else {
        $query = "INSERT INTO appointment (userID, dentistID, appointmentDate, appointmentTime, appointment_Category)
        VALUES ('$selectedUser', '$dentistID', '$formatDate', '$selectedTime', '$specialization')";

        if (mysqli_query($conn, $query)) {
            $appStatus = "Your appointment has been booked successfully.";
            echo "<script>alert('$appStatus'); </script>";
            echo "<script>window.location.href = 'appointmentlist_user.php?userID=$selectedUser';</script>";
        } else {
            $appStatus = "Error booking appointment: " . mysqli_error($conn);
            echo "<script>alert('$appStatus'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Dental Appointment</title>
    <link href="appointment_add_user.css" rel="stylesheet">
</head>
<body>
<form method="POST" action="">
    <h1>Book Appointment</h1>
    
    <label for="dentist">Choose a Dentist</label>
    <select name="dentist" required>
        <option value="" selected disabled>Dentist</option>
        <option value="1|General">Dr. Kenny Chiang - General</option>
        <option value="2|General">Dr. Roziana binti Kamil - General</option>
        <option value="3|Braces and Implants">Dr. Joanne Leow - Braces and Implants</option>
        <option value="4|Root Canal">Dr. Yang Chin Peng - Root Canal</option>
        <option value="5|Dental X-Rays">Dr. Kandiah - Dental X-Rays</option>
    </select>
    <br>
    <label for="date">Select Appointment Date</label>
    <input type="date" id="date" name="date" placeholder="Date" value="" required><br><br>
    
    <label for="time">Select Appointment Time</label>
    <select name="time" required>
        <option value="" selected disabled>Time</option>
        <option value="8:00AM">8:00AM</option>
        <option value="10:00AM">10:00AM</option>
        <option value="2:00PM">2:00PM</option>
        <option value="4:00PM">4:00PM</option>
    </select>
    <br>
    <br>
    <br>
    <div>
        <input type="submit" value="Book Appointment">
        <input type="button" value="Return" onclick="redirectToAppointmentList();">
    </div>
    
</form>

<script>
    function redirectToAppointmentList() {
        var selectedUser = "<?php echo $selectedUser; ?>";
        window.location.href = "appointmentlist_user.php?userID=" + selectedUser;
    }
</script>

</body>
</html>