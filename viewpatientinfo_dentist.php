<?php

    session_start();
    include('config.php');
    $id = $_GET['userID'];
    //echo $id;

    function getGender() {
        return array('F'=>'Female', 'M'=>'Male');
    }

    $GENDERS = getGender();

    function getDentist() {
    
        return array('1'=>'Kenny Chiang', '2'=>'Roziana binti Kamil', '3' => 'Joanne Leow', '4' => 'Yang Chin Peng', '5' => 'Kandiah Ganpati a/l Dharmalingam');
    }

    $Dentists = getDentist();

    function getComment() {
        include('config.php');
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="viewpatientinfo_dentist.css">
    </head>
    <body>
        <h1>Patient Info</h1>
        
        <form>
            <?php
                $sql = "SELECT * FROM User WHERE userID = $id";
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

            <div class="appointmentInfo">
                <?php 
                $sql = "SELECT * FROM Appointment WHERE userID = $id  ORDER BY appointmentDate, appointmentTime ASC";
                $result = mysqli_query($conn, $sql);
                echo "<table border=1 cellpadding=5>
                <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Category</th>
                        <th>Doctor</th>
                        <th>Comments</th>
                </tr>";
                
                $count = 1;

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {

                        $appointment = $row['appointmentID'];
                        $sql2 = "SELECT * FROM Comment WHERE appointmentID = $appointment";
                        $result2 = mysqli_query($conn, $sql2);
                        
                        if(mysqli_num_rows($result2) > 0) {
                            $row2 = mysqli_fetch_array($result2);
                            $comments = $row2['descriptions'];
                        }
                        else {
                            $comments = "-";
                        }

                        printf('
                        <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                        </tr>',
                            $count,
                            $row['appointmentDate'],
                            $row['appointmentTime'],
                            $row['appointment_category'],
                            $Dentists[$row['dentistID']],
                            $comments
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

        </form>
    </body>
</html>