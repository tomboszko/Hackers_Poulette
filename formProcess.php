<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.min.css">
    <title>Thank You!</title>
</head>
<body>
    


<?php
session_start(); // start session (only way found to reset the form when goback button is clicked)
// require PHPMailer
require 'vendor/autoload.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if honeypot field is filled
    if (!empty($_POST['honeypot'])) {
        die('Spam detected');
    }
    // set variables to empty values
    $name = trim(htmlspecialchars($_POST['name']));
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    $email = trim(htmlspecialchars($_POST['email']));
    $message = trim(htmlspecialchars($_POST['message']));
    // set error variable
    $error = '';
    // Validate fields...
    if (empty($name) || empty($lastname) || empty($email) || empty($message)) {
        $error = 'All fields are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } elseif (preg_match('/[^a-z\s-]/i', $name) || preg_match('/[^a-z\s-]/i', $lastname)) {
        $error = 'Name and lastname can only contain letters, spaces, and hyphens';
    }
    // If no errors, display success message...
    if (empty($error)) {
        echo '<div id="success">';
        echo '<img src="assets/picture/hackers-poulette-logo.png" alt="logo" width="200px">';
        echo '<p>Thank you for your message, we will respond you as soon as possible !</p>';
        //display go back button
        echo '<button id="btnDone" onclick="goBack()">Home</button>';
        echo '<script>
            function goBack() {
                window.history.back();
            }
            </script>';
        echo '</div>';

            } else {
                echo '<p>' . $error . '</p>';
            }
}
// If no errors, set session variable to true...
if (empty($error)) {
    $_SESSION['submitted'] = true;
}
// If session variable is set, reset form...
if (isset($_SESSION['submitted'])) {
    unset($_SESSION['submitted']);
    echo '<script>document.getElementById("contactForm").reset();</script>';
}

// If no errors, send email...
$mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();             // Set mailer to use SMTP
            $mail->Host = 'localhost';   // Specify main and backup SMTP servers
            $mail->SMTPAuth = false;     // Disable SMTP authentication
            $mail->Port = 1025;          // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $lastname);
            $mail->addAddress('hacker.poulettes@gmail.com', 'Hacker Poulettes');     // Add a recipient
            $mail->addReplyTo('admin@hackerpoulette.com', 'Admin');

            //Content
            $mail->isHTML(true);          // Set email format to HTML
            $mail->Subject = $_POST['subject'];
            $mail->Body    = 'This is the HTML message body: <b>' . $message . '</b>';
            $mail->AltBody = ' . $message . ';
            //send email
            $mail->send();
           // echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        // function to see what is in $_POST
         //print_r($_POST);

?>

</body>
</html>