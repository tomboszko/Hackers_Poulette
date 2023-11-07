<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="assets/css/style.min.css">
    <title>Hackers Poulette</title>
</head>
<body>

<header>
    
    <div id="homeImg">
    
</div>

</header>
    
<main>
<div id="contactUs">
    <div id="contactUsTitle">
        
        <img src="assets/picture/hackers-poulette-logo.png" alt="logo" width="100">
        <p id="formTitle">Fill in the form below to contact us.</p>
    </div>

    <form id="contactForm" method="post" action="formProcess.php" autocomplete="on">

        <label class="label" for="name">Name:</label><br>
        <input type="text" id="name" name="name" placeholder="Your name" aria-label="Name" required>
        <span id="nameError" style="color: red;"></span><br>

        <label class="label" for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" placeholder="Your lastname" aria-label="Last Name" required>
        <span id="lastnameError" style="color: red;"></span><br>

        <label class="label" for="gender">Gender:</label><br>
        <select id="gender" name="gender" aria-label="Gender" required>
            <option value="">Select...</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <span id="genderError" style="color: red;"></span><br>

        <label class="label" for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="name@xyz.com" aria-label="Email" required>
        <span id="emailError" style="color: red;"></span><br>

        <label class="label" for="country">Country:</label><br>
        <select id="country" name="country" aria-label="Country" required>
        <option value="">Select your country</option>
        <?php
        $countries = array(
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Saudi Arabia", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belgium", "Belize", "Benin", "Bhutan", "Belarus", "Myanmar", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Chile", "China", "Cyprus", "Colombia", "Comoros", "North Korea", "South Korea", "Costa Rica", "Ivory Coast", "Croatia", "Cuba", "Denmark", "Djibouti", "Dominica", "Egypt", "United Arab Emirates", "Ecuador", "Eritrea", "Spain", "Eswatini", "Estonia", "United States", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Equatorial Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Cook Islands", "Marshall Islands", "India", "Indonesia", "Iraq", "Iran", "Ireland", "Iceland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kyrgyzstan", "Kiribati", "Kuwait", "Laos", "Lesotho", "Latvia", "Lebanon", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "North Macedonia", "Madagascar", "Malaysia", "Malawi", "Maldives", "Mali", "Malta", "Morocco", "Mauritius", "Mauritania", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Mozambique", "Namibia", "Nauru", "Nepal", "Nicaragua", "Niger", "Nigeria", "Niue", "Norway", "New Zealand", "Oman", "Uganda", "Uzbekistan", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Netherlands", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Central African Republic", "Dominican Republic", "Republic of the Congo", "Czech Republic", "Romania", "United Kingdom", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "San Marino", "Solomon Islands", "El Salvador", "Samoa", "São Tomé and Príncipe", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Somalia", "Sudan", "South Sudan", "Sri Lanka", "Sweden", "Switzerland", "Suriname", "Syria", "Tajikistan", "Tanzania", "Chad", "Thailand", "East Timor", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkmenistan", "Turkey", "Tuvalu", "Ukraine", "Uruguay", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe",
        );

        foreach ($countries as $country) {
            echo '<option value="' . $country . '">' . $country . '</option>';
        }
        ?>
        </select>
        <span id="countryError" style="color: red;"></span><br>

        <label class="label" for="subject">Subject:</label><br>
        <select id="subject" name="subject" aria-label="Subject">
            <option value="Other">Other</option>
            <option value="Product">Product</option>
            <option value="Delivery">Delivery</option>
        </select>
        <span id="subjectError" style="color: red;"></span><br>

        <label class="label" for="message">Message:</label><br>
        <textarea id="message" name="message" placeholder="Your message..." aria-label="Message" rows="4" cols="42" required></textarea>
        <span id="messageError" style="color: red;"></span><br>

        <!--Honeypot field-->
        <input type="text" id="honeypot" name="honeypot" style="display: none;"><br>
        <input type="submit" id="submitButton" value="Submit">
    </form>
    </div>

</main>

<footer>
    <p>All rights reserved by the Toma-Cola Company</p>
</footer>
</body>
</html>

