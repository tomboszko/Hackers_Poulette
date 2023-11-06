<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include PHPMailer classes to send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

    // If no errors, send email...
    if (empty($error)) {
        $subject = $_POST['subject'];

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = getenv('SMTP_HOST') ?: '';              // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = getenv('SMTP_USERNAME') ?: '';      // SMTP username
            $mail->Password = getenv('SMTP_PASSWORD') ?: '';      // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            echo '<script>alert("Thank you for your message, we will respond you as soon as possible !");</script>';
        } catch (Exception $e) {
            $error = 'Failed to send email. Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    if (!empty($error)) {
        echo '<p>' . $error . '</p>';
    }
}
?>