<?php
session_start();
include('config.php');

function getDentist() {
    include('config.php');
    $dentID = $_GET['dentistID'];

    $sql = "SELECT * FROM Dentist WHERE dentistID = '$dentID' ";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_array($result);
    }

    return $row['name'];
}

$Dentists = getDentist();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="appointment_delete_user.css">
</head>

<body>
    <div class="navbar">
        <nav>
            <ul>
                <li><a href="dashboard_loggedin.html">HOME</a></li>
                <li><a href="#about">ABOUT US</a></li>
                <li><a href="#services">SERVICES</a></li>
                <li><a href="#contact">CONTACT US</a></li>
                <li><a href="Login.php">MY APPOINTMENT</a></li>
                <li><a href="Login.php">LOG OUT</a></li>
                <li class="navLogo"><img src="images/logo-removebg.png" alt="ProCare Dental Clinic"></li>
            </ul>
        </nav>
    </div>

    <?php 
    $selectedUser = $_SESSION['ID'];
    $selectedAppointment = $_GET['appointmentID'];

    $sql = "SELECT * FROM Appointment WHERE appointmentID = '$selectedAppointment' AND userID = '$selectedUser' ";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_array($result);
    }
    ?>

    <form action="" method="post">
        <div class="info">
            <img src="images/delete.png" alt="Delete Icon">
            <h3>APPOINTMENT INFO</h3>
            <table>
                <tr>
                    <th align="left">Appointment Date</th>
                    <td align="left">:</td>
                    <td align="left"><?php echo $row['appointmentDate']; ?></td>
                </tr>
                <tr>
                    <th align="left">Appointment Time</th>
                    <td align="left">:</td>
                    <td align="left"><?php echo $row['appointmentTime']; ?></td>
                </tr>
                <tr>
                    <th align="left">Appointment Category</th>
                    <td align="left">:</td>
                    <td align="left"><?php echo $row['appointment_category']; ?></td>
                </tr>
                <tr> 
                    <th align="left">Dentist In Charge</th>
                    <td align="left">:</td>
                    <td align="left"><?php echo $Dentists; ?></td>
                </tr>
            </table>
        </div>

        <div class="buttons">
            <input type="button" value="Delete Appointment" onclick="deleteApp()">
            <input type="button" value="Return" onclick="redirectToAppointmentList()">
        </div>
    </form>

    <script>
        function redirectToAppointmentList() {
            var selectedUser = "<?php echo $selectedUser; ?>";
            window.location.href = "appointmentlist_user.php?userID=" + selectedUser;
        }

        function deleteApp() {
            if (confirm("Are you sure you want to delete this appointment?")) {
                var app = "<?php echo $selectedAppointment; ?>";
                window.location.href = "appointment_delete.php?appointmentID=" + app;
            }
        }
    </script>
</body>
</html>
