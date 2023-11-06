<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="script.js"></script>
    <title>Hackers Poulette</title>
</head>
<body>

<header>
    <h1>Contact form</h1>
</header>
    

<form id="contactForm" method="post" action="index.php">

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
<select id="country" name="country" aria-label="Country" required>
    <option value="">Select your country</option>
    <?php
    $countries = array(
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Saudi Arabia", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belgium", "Belize", "Benin", "Bhutan", "Belarus", "Myanmar", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Chile", "China", "Cyprus", "Colombia", "Comoros", "North Korea", "South Korea", "Costa Rica", "Ivory Coast", "Croatia", "Cuba", "Denmark", "Djibouti", "Dominica", "Egypt", "United Arab Emirates", "Ecuador", "Eritrea", "Spain", "Eswatini", "Estonia", "United States", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Equatorial Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Cook Islands", "Marshall Islands", "India", "Indonesia", "Iraq", "Iran", "Ireland", "Iceland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kyrgyzstan", "Kiribati", "Kuwait", "Laos", "Lesotho", "Latvia", "Lebanon", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "North Macedonia", "Madagascar", "Malaysia", "Malawi", "Maldives", "Mali", "Malta", "Morocco", "Mauritius", "Mauritania", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Mozambique", "Namibia", "Nauru", "Nepal", "Nicaragua", "Niger", "Nigeria", "Niue", "Norway", "New Zealand", "Oman", "Uganda", "Uzbekistan", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Netherlands", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Central African Republic", "Democratic Republic of the Congo", "Dominican Republic", "Republic of the Congo", "Czech Republic", "Romania", "United Kingdom", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Vincent and the Grenadines", "Saint Lucia", "San Marino", "Solomon Islands", "El Salvador", "Samoa", "São Tomé and Príncipe", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Somalia", "Sudan", "South Sudan", "Sri Lanka", "Sweden", "Switzerland", "Suriname", "Syria", "Tajikistan", "Tanzania", "Chad", "Thailand", "East Timor", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkmenistan", "Turkey", "Tuvalu", "Ukraine", "Uruguay", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe",
    );

    foreach ($countries as $country) {
        echo '<option value="' . $country . '">' . $country . '</option>';
    }
    ?>
</select><br>

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
        echo '<script>alert("Thank you for your message, we will respond you as soon as possible !");</script>';
    } else {
        echo '<p>' . $error . '</p>';
    }
}



// If no errors, send email...
$mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'localhost';                            // Specify main and backup SMTP servers
            $mail->SMTPAuth = false;                              // Disable SMTP authentication
            $mail->Port = 1025;                                   // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $lastname);
            $mail->addAddress('hacker.poulettes@gmail.com', 'Hacker Poulettes');     // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $_POST['subject'];
            $mail->Body    = 'This is the HTML message body: <b>' . $message . '</b>';
            $mail->AltBody = ' . $message . ';

            $mail->send();

           // echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

         //print_r($_POST);
    


?>


</body>
</html>

