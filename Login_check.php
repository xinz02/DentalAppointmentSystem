<?php
session_start();
include('config.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    $sql1 = "SELECT * FROM User WHERE username='$myusername'";
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "SELECT * FROM Dentist WHERE username='$myusername'";
    $result2 = mysqli_query($conn, $sql2);

    if ($result1 || $result2) {
        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $myid = $row['userID'];
        } elseif ($result2 && mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $myid = $row['dentistID'];
        }

        if (isset($row)) {
            $storedPassword = $row['password'];
            $mycategory = $row['category'];

            if (md5($mypassword) === $storedPassword) {
                $_SESSION["Login"] = "YES";
                $_SESSION['USER'] = $myusername;
                $_SESSION['PASSWORD'] = $storedPassword;
                $_SESSION['CATEGORY'] = $mycategory;
                $_SESSION['ID'] = $myid;
                header("Location: dashboard_loggedin.html");
            } else {
                $_SESSION["Login"] = "NO";
                $error = "<p>Incorrect password.<p>";
                //header("Location: Login.php");
                /*echo "<div class='error'>";
                echo "<p>Incorrect password.<p>";
                echo "</div>";*/
            }
        } else {
            $_SESSION["Login"] = "NO";
            $error = "<p>No account found, please register one.<p>";
            //header("Location: Login.php");
            /*echo "<div class='error'>";
            echo "<p>No account found, please register one.<p>";
            echo "</div>";*/
        }
    } else {
        $_SESSION["Login"] = "NO";
        $error = "<p>No account found, please register one.<p>";
        //header("Location: Login.php");
        /*echo "<div class='error'>";
        echo "<p>No account found, please register one.<p>";
        echo "</div>";*/
    }

    if(isset($error)) {
        //return $error;
        header("Location: Login.php?error=$error");
    }

}

?>