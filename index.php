<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackers Poulette</title>
</head>
<body>

<header>
    <h1>Contact form</h1>
</header>
    
<?php


$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $lastname = htmlspecialchars($_POST['lastname']);
    // Sanitize other fields...

    // Check if honeypot field is filled
    if (!empty($_POST['honeypot'])) {
        die('Spam detected');
    }

    // Validate fields...
    if (empty($name) || empty($lastname) /* || other fields are empty... */) {
        $error = 'All fields are required';
    }
}
// If no errors, send email...
if (empty($error)) {
    $to = 'gomreethomas@gmail.com';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : 'Other';
    $message = $_POST['message'];
    if(mail($to, $subject, $message)){
        echo '<script>alert("Your request as been sent !");</script>';
    } else {
        $error = 'Failed to send email';
    }
}

?>


<form method="post" action="index.php">

    <label class="label" for="name">Name:</label><br>
    <input type="text" id="name" name="name" aria-label="Name" required><br>

    <label class="label" for="lastname">Last Name:</label><br>
    <input type="text" id="lastname" name="lastname" aria-label="Last Name" required><br>

    <label class="label" for="gender">Gender:</label><br>
    <select id="gender" name="gender" aria-label="Gender" required>
        <option value="">Select...</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br>

    <label class="label" for="email">Email:</label><br>
    <input type="email" id="email" name="email" aria-label="Email" required><br>

    <label class="label" for="country">Country:</label><br>
    <input type="text" id="country" name="country" aria-label="Country" required><br>


    <label class="label" for="subject">Subject:</label><br>
    <select id="subject" name="subject" aria-label="Subject">
        <option value="Other">Other</option>
        <option value="Option 1">Product</option>
        <option value="Option 2">Delivery</option>
        <option value="Option 3">Documentation</option>
    </select><br>

    <label class="label" for="message">Message:</label><br>
    <textarea id="message" name="message" aria-label="Message" required></textarea><br>

    <!--Honeypot field-->
    <input type="text" id="honeypot" name="honeypot" style="display: none;"><br>

    <input type="submit" value="Submit">
</form>

<?php
if (!empty($error)) {
    echo '<p>' . $error . '</p>';
}
?>

<?php
print_r($_POST);
?>

</body>
</html>

