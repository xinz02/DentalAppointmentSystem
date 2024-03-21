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
                /*
                if ($_SESSION['CATEGORY'] == 1) {
                    header("Location: appointmentlist_user.php?userID=" . $_SESSION['ID']);
                } else {
                    header("Location: appointmentlist_dentist.php?dentistID=" . $_SESSION['ID']);
                }*/
                header("Location: dashboard_loggedin.html");
            } else {
                $_SESSION["Login"] = "NO";
                //header("Location: Login.php");
                echo "<div class='error'>";
                echo "<p>Incorrect password.<p>";
                echo "</div>";
            }
        } else {
            $_SESSION["Login"] = "NO";
            //header("Location: Login.php");
            echo "<div class='error'>";
            echo "<p>No account found, please register one.<p>";
            echo "</div>";
        }
    } else {
        $_SESSION["Login"] = "NO";
        //header("Location: Login.php");
        echo "<div class='error'>";
        echo "<p>No account found, please register one.<p>";
        echo "</div>";
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
        <link href="Login.css" rel="stylesheet">
    </head>

    <body>
        
        <div class="form-container"></div>
        <form action="" method="post">
            
            <div class="login-container">
                <h1>Login Page</h1>
                <div class="login-field">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="Username">
                </div>

                <div class="login-field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required placeholder="Password">
                </div>

                <div class="login-field">
                    <input type="submit" value="Log In">
                </div>

                <div class="login-field">
                    <p><a href="SignUp.php"><strong>Don't have an account?</strong></a></p>
                </div>
            </div>
        </form>
    </body>
</html>