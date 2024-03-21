
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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appointment</title>
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="app.css">
        <link rel="stylesheet" href="appointmentlist_dentist.css">
        <script>
            function toAppList() {
                window.location.href = "dashboard_loggedin.html";
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

            $sql = "SELECT * FROM Dentist WHERE dentistID = $id" ;
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
                    <h3><u>Dentist Info</u></h3>
                    <table>
                        <tr>
                            <th align="left">Name:</th>
                            <td align="left"><?php echo $row['name']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Specialization:</th>
                            <td align="left"><?php echo $row['specialization']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Phone:</th>
                            <td align="left"><?php echo $row['phone']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Email:</th>
                            <td align="left"><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <th align="left">Gender:</th>
                            <td align="left"><?php echo $GENDERS[$row['gender']]; ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php 
            $sql = "SELECT * FROM Appointment WHERE dentistID = $id ORDER BY appointmentDate, appointmentTime ASC";
            $result = mysqli_query($conn, $sql);
            echo "<table border=1 cellpadding=5>
            <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Category</th>
                    <th>Action</th>
            </tr>";
            
            $count = 1;
                        //<a href="" onclick="prompt(\'Enter your comment on this appointment: \', \'No longer than 25 words.\')">Enter comment</a>
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    printf('
                    <tr>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>
                        <a href="" onclick="window.open(\'viewpatientinfo_dentist.php?userID=%s\', \'popup\', \'width=1000,height=1000\')">View Patient Info</a>
                        <a href="add_comment.php?appointmentID=%s">Enter comment</a>
                        </td>
                    </tr>',
                        $count,
                        $row['appointmentDate'],
                        $row['appointmentTime'],
                        $row['appointment_category'],
                        $row['userID'],
                        $row['appointmentID']
        
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

            <div class="appointmentInfo">
                <table></table>
            </div>
        
        </div>

        <div class="addApp-container">
            <button class="addApp" onclick="toAppList()">Return</button>
        </div>

    </body>
</html>