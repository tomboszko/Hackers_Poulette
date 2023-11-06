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
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    

    // Check if honeypot field is filled
    if (!empty($_POST['honeypot'])) {
        die('Spam detected');
    }

     // Validate fields...
     if (empty($name) || empty($lastname) || empty($email) || empty($message)) {
        $error = 'All fields are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    } elseif (preg_match('/\d/', $name) || preg_match('/\d/', $lastname)) {
        $error = 'Name and lastname cannot contain numbers';
    }

    // If no errors, send email...
    if (empty($error)) {
        $to = 'gomreethomas@gmail.com';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 'Other';
        if(mail($to, $subject, $message)){
            echo '<script>alert("Your request has been sent !");</script>';
        } else {
            $error = 'Failed to send email';
        }
    }
}
?>


<form method="post" action="index.php">

    <label class="label" for="name">Name:</label><br>
    <input type="text" id="name" name="name" placeholder="Your name" aria-label="Name" required><br>

    <label class="label" for="lastname">Last Name:</label><br>
    <input type="text" id="lastname" name="lastname" placeholder="Your lastname" aria-label="Last Name" required><br>

    <label class="label" for="gender">Gender:</label><br>
    <select id="gender" name="gender" aria-label="Gender" required>
        <option value="">Select...</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br>

    <label class="label" for="email">Email:</label><br>
    <input type="email" id="email" name="email" placeholder="name@xyz.com" aria-label="Email" required><br>

    <label class="label" for="country">Country:</label><br>
    <input type="text" id="country" name="country" placeholder="Your country" aria-label="Country" required><br>


    <label class="label" for="subject">Subject:</label><br>
    <select id="subject" name="subject" aria-label="Subject">
        <option value="Other">Other</option>
        <option value="Product">Product</option>
        <option value="Delivery">Delivery</option>
    </select><br>

    <label class="label" for="message">Message:</label><br>
    <textarea id="message" name="message" placeholder="Your message..." aria-label="Message" required></textarea><br>

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

