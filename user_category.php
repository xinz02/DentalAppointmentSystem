



<?php
include('config.php');
include('Login_check.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION["Login"] == "YES") {
    /*if (isset($_SESSION['USERNAME']) && isset($_SESSION['PASSWORD'] && isset($_SESSION['CATEGORY']))){*/

            if ($_SESSION['CATEGORY'] == 1) {
                    header("Location: appointmentlist_user.php?userID=" .$_SESSION['ID']);
                    exit();
                } else if ($_SESSION['CATEGORY'] == 2) {
                    header("Location: appointmentlist_dentist.php?dentistID=" .$_SESSION['ID']);
                    exit();
                }
             else {
                echo "<div class='error'>";
                echo "<p>Invalid user category.<p>";
                echo "</div>";
            }
        } else {
            header("Location: LoginPage.php");
        }
//        }

    

    
?>









