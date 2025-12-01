<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "message";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    // create the connection before using it
    $con = mysqli_connect($servername, $username, $password, $dbname);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
   

    // use a prepared statement to avoid SQL injection
    $stmt = $con->prepare("INSERT INTO `data` (`fullname`, `email`, `phone`, `subject`, `message`) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $con->error);
    }

    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $stmt->bind_param("sssss", $fullname, $email, $phone, $subject, $message);
    $result = $stmt->execute();

    if ($result) {
        echo "Your Message Sent successfully! <br> THANK YOU! We will send you a reply to your email address or To Your Phone very soon.";
        echo "<a href='../index.php'> <br> Back to Home</a>";
        echo "<a href='contact.php'> <br> Send Message Again</a>";
    } else {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $con->close();
}
?>