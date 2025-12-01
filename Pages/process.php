<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

     $sql = "INSERT INTO `data` (`full-name`, `email`, `phone`, `subject`, `message`) VALUES ('$fullname', '$email', '$phone', '$subject', '$message')";


$con = new mysqli("localhost", "root", "", 'message');
if ($con->query($sql) === TRUE) {
    header("Location: success.php?status=success");
   
} else {
    header("Location: contact.php?status=error");
}

}
$con->close();
?>