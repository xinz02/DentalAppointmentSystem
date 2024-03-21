<?php
session_start();
include('config.php');

if ($_SESSION['Login'] == "NO") {
    header("Location: Login.php");
}

$appointmentID = $_GET['appointmentID'];
$selectedUser = $_SESSION['ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $comment = $_POST['comment'];

    $sql = "SELECT * FROM Comment WHERE appointmentID = '$appointmentID'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $commentStatus = "Fail to add comment: This appointment already has a comment.";
        echo "<script>alert('$commentStatus')</script>";
    }
    else {
        $sql = "INSERT INTO Comment (appointmentID, descriptions) VALUES ('$appointmentID', '$comment')";

        if (mysqli_query($conn, $sql)) {
            $commentStatus = "Comment added.";
            echo "<script>alert('$commentStatus'); </script>";
            echo "<script>window.location.href = 'appointmentlist_dentist.php?dentistID=$selectedUser';</script>";
        } else {
            echo "Error adding comment: " . mysqli_error($conn);
        }
    }

    // Insert the comment into the Comment table
    

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
    <link href="add_comment.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <h1>Add Comment</h1>

    <form action="" method="POST">
        <label for="comment">Comment:</label>
        <input type="text" name="comment" id="comment" maxlength="25" required>
        <br>
        <input type="submit" value="Submit">
        <input type="button" value="Return" onclick="redirectToAppointmentList();">
    </form>
    </div>
    
<script>
    function redirectToAppointmentList() {
        var selectedUser = "<?php echo $selectedUser; ?>";
        window.location.href = "appointmentlist_dentist.php?dentistID=" + selectedUser;
    }
</script>
    
</body>
</html>

