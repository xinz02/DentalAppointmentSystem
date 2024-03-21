
<?php 
session_start();
include('config.php');
//include('Login_check.php'); //session start included

    if($_SESSION['Login'] == "NO") {
        header("Location: Login.php");
    }

    function getGender() {
        return array('F'=>'Female', 'M'=>'Male');
    }

    $GENDERS = getGender();

    function getDentist() {
        //include('config.php');
        return array('1'=>'Kenny Chiang', '2'=>'Roziana binti Kamil', '3' => 'Joanne Leow', '4' => 'Yang Chin Peng', '5' => 'Kandiah Ganpati a/l Dharmalingam');
        /*
        $dentID = $_GET['dentistID'];

        $sql = "SELECT * FROM Dentist WHERE dentistID = '$dentID' ";
        $result = mysqli_query($conn, $sql);
        
        if($result) {
            $row = mysqli_fetch_array($result);
        }

        return $row['name'];*/
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
        <link rel="stylesheet" href="appointmentlist_user.css">
        <script>
            function toAddApp(userID) {
                window.location.href = "appointment_add_user.php?userID=" + userID;
            }
        </script>

    </head>
    <body>
    
    <div class="navbar">
        <nav>
            <ul>
                <li><a href="dashboard_loggedin.html">HOME</a></li>
                <li><a href= "dashboard_loggedin.html#about">ABOUT US</a></li>
                <li><a href="dashboard_loggedin.html#services">SERVICES</a></li>
                <li><a href="dashboard_loggedin.html#contact">CONTACT US</a></li>
                <li><a href="#">MY APPOINTMENT</a></li>
                <li><a href="logout.php">LOG OUT</a></li>
                <li class="navLogo"><img src="images/logo-removebg.png" alt="ProCare Dental Clinic"></li>
            </ul>
        </nav>
    </div>

        <div class="container">
            <div class="title">
            <h1>My appointment</h1>
            </div>

            <?php 
            $id = $_SESSION['ID'];

            $sql = "SELECT * FROM User WHERE userID = $id" ;
            $result = mysqli_query($conn, $sql);

            if($result) {
                $row = mysqli_fetch_array($result);
            }
            ?>

            <div class="pInfo">
                <?php
                    if ($row['gender'] === 'F') {
                        echo "<img src='images/women_avatar.PNG'>";
                    } else {
                        echo "<img src='images/man_avatar.PNG'>";
                    }
                ?>
                
                <div class="info">
                    <h3><u>Patient Info</u></h3>
                    <table>
                        <tr>
                            <th align="left">Name:</th>
                            <td align="left"><?php echo $row['name']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Age:</th>
                            <td align="left"><?php echo $row['age']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Gender:</th>
                            <td align="left"><?php echo $GENDERS[$row['gender']]; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Email:</th>
                            <td align="left"><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Contact Number:</th>
                            <td align="left"><?php echo $row['phone']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php 
            $sql = "SELECT * FROM Appointment WHERE userID = $id ORDER BY appointmentDate, appointmentTime ASC";
            $result = mysqli_query($conn, $sql);
            echo "<table border=1 cellpadding=5>
            <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Category</th>
                    <th>Doctor</th>
                    <th>Action</th>
            </tr>";
            
            $count = 1;

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    printf('
                    <tr>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>
                            <a href="appointment_delete_user.php?appointmentID=%s&dentistID=%s">Delete</a>&nbsp;&nbsp;
                            
                        </td>
                    </tr>',
                        $count,
                        $row['appointmentDate'],
                        $row['appointmentTime'],
                        $row['appointment_category'],
                        $Dentists[$row['dentistID']],
                        //$row['dentistID'],
                        $row['appointmentID'],
                        $row['dentistID']
                    );
                    $count++;
                }
            }
            else {
                echo 
                "<tr><td align=center colspan=6>---No appointment yet---</td></tr>";
                
            }
            echo "</table>";
            ?>
        
        </div>

        <div class="addApp-container">
            <button class="addApp" onclick="toAddApp(<?php echo $id;?>)">Add Appointment</button>
        </div>

    </body>
</html>