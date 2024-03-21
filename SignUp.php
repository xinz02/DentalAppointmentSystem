<?php


function showErrorIcon() {
    echo "<img style='vertical-align: middle' src='images/error.png' alt='Error'>";
}

function detectError() {
    global $username, $phone, $age, $password, $confirmpassword, $name, $gender, $email; //make it global variable
    $error = array();

    if ($name == null) {
        $error['name'] = "Please enter <strong>Name</strong>.";
    }

    if ($age == null) {
        $error['age'] = "Please enter <strong>Age</strong>.";
    } else if (!preg_match('/^[0-9]{1,2}$/', $age)) {
        $error['age'] = "Age is in an invalid format.";
    }

    if ($username == null) {
        $error['username'] = "Please enter <strong>Username</strong>.";
    } else if (!preg_match('/^[a-zA-Z]/', $username)) { //php regular expression   [0-9] = \d 
        $error['username'] = "<strong>Username</strong> is in an invalid format. The username should begin with an alphabet.";
    }

    if ($password == null) {
        $error['password'] = "Please enter <strong>Password</strong>.";
    } else if (!preg_match('/^\w{8,15}$/', $password)) {
        $error['password'] = "<strong>Password</strong> must be between 8 to 15 characters.";
    }

    if ($confirmpassword == null) {
        $error['confirmpassword'] = "Please enter <strong>Confirm Password</strong>.";
    } else if ($confirmpassword != $password) {
        $error['confirmpassword'] = "<strong>Confirm Password</strong> must match the password.";
    }

    if ($email == null) {
        $error['email'] = "Please enter an <strong>Email Address</strong>.";
    } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $error['email'] = "<strong>Email Address</strong> is in an invalid format.";
    }

    if ($phone == null) {
        $error['phone'] = "Please enter your <strong>Phone Number</strong>.";
    } else if (!preg_match('/^[0-9]{8,12}$/', $phone)) {
        $error['phone'] = "<strong>Phone Number</strong> is in an invalid format.";
    }

    if($gender == null) {
        $error['gender'] = "Please select your <strong>Gender</strong>";
    }

    return $error;
}

$showInfo = false;

if (!empty($_POST)) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);
    $name = trim($_POST['name']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $error = detectError();

    if (empty($error)) {
        $showInfo = true;
        include('insert_user.php');
        $name = '';
        $gender = '';
        $age = '';
        $username = '';
        $email = '';
        $phone = '';

    } else {
        echo "<div class='error'>";
        echo "<ul>";
        foreach ($error as $value) {
            echo "<li>$value</li>";
        }
        echo "</ul>";
        echo "</div>";
    }

    if ($showInfo) {
        echo "<div class='success'>";
        echo "Account Created!";
        echo "<a href='Login.php'> Click to Login</a>";
        echo "</div>";
        //echo "<script> clearForm(); </script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link href="Signup.css" rel="stylesheet">
    </head>

    <body>
        <form action="" method="post" class="Signup-container">
            <h1>Sign Up</h1>

            <table cellspacing="0" cellpadding="0" >
                <tr >
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" name="name" id="name" value="<?php if(isset($error)) echo $name; ?>"></td>
                    <td><?php if (isset($error['name'])) showErrorIcon() ?></td>
                </tr>
                <tr >
                    <td><label for="age">Age:</label></td>
                    <td><input type="text" name="age" id="age" value="<?php if(isset($error)) echo $age; ?>"></td>
                    <td><?php if (isset($error['age'])) showErrorIcon() ?></td>
                </tr>
                <tr >
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" name="username" id="username" value="<?php if(isset($error)) echo $username; ?>"></td>
                    <td><?php if (isset($error['username'])) showErrorIcon() ?></td>
                </tr>
                <tr >
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password" id="password" maxlength="15"></td>
                    <td><?php if (isset($error['password'])) showErrorIcon() ?></td>
                </tr>
                <tr >
                    <td><label for="confirmpassword">Confirm Password:</label></td>
                    <td><input type="password" name="confirmpassword" id="confirmpassword" maxlength="15"></td>
                    <td><?php if (isset($error['confirmpassword'])) showErrorIcon() ?></td>
                </tr>
                <tr>
                    <td><label for="email">Email Address:</label></td>
                    <td><input type="text" name="email" id="email" value="<?php if(isset($error)) echo $email; ?>"></td>
                    <td><?php if (isset($error['email'])) showErrorIcon() ?></td>
                </tr>
                <tr >
                    <td><label for="phone">Contact Number:</label></td>
                    <td><input type="text" name="phone" id="phone" value="<?php if(isset($error)) echo $phone; ?>"></td>
                    <td><?php if (isset($error['phone'])) showErrorIcon() ?></td>
                </tr>
                <tr >
                    <td><label for="phone">Gender:</label></td>
                    <td>
                        <input type="radio" name="gender" id="male" value="M" <?php if(isset($error) && $gender==="M") echo "checked" ?>>
                        <label for="male">Male</label>
                    </td>
                    <td>
                        <input type="radio" name="gender" id="female" value="F" <?php if(isset($error) && $gender==="F") echo "checked" ?>>
                        <label for="female">Female</label>
                    </td>
                    <td><?php if (isset($error['gender'])) showErrorIcon() ?></td>
                </tr>
            </table>
            <div class="Signup-field">
                <input type="submit" name="submit" value="Submit">
                
                <input type="reset" value="Reset">
            </div>
        </form>

    </body>

</html>