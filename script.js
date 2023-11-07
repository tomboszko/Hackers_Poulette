// script to prevent form submission if fields are not valid
function validateName(name) {
    var re = /^[A-Za-z\s]+$/; // only letters and spaces
    return re.test(name);
}
function validateLastName(lastName) {
    var re = /^[A-Za-z\s]+$/; // only letters and spaces
    return re.test(lastName);
}
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/; // check if email is valid
    return re.test(email);
}
function validateCountry(country) {
    return country !== '';
}
function validateMessage(message) {
    return message.trim() !== ''; // check if message is not empty
}
document.getElementById('contactForm').addEventListener('submit', function (event) {
    var name = document.getElementById('name').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var country = document.getElementById('country').value;
    var message = document.getElementById('message').value;

    if (!validateName(name) || !validateName(lastname)) {
        document.getElementById('nameError').textContent = "Name and lastname cannot contain numbers or special characters.";
        event.preventDefault();
    } else {
        document.getElementById('nameError').textContent = "";
    }
    if (!validateEmail(email)) {
        document.getElementById('emailError').textContent = "Invalid email.";
        event.preventDefault();
    } else {
        document.getElementById('emailError').textContent = "";
    }
    if (!validateCountry(country)) {
        document.getElementById('countryError').textContent = "Select a country.";
        event.preventDefault();
    } else {
        document.getElementById('countryError').textContent = "";
    }
    if (!validateMessage(message)) {
        document.getElementById('messageError').textContent = "Message cannot be empty.";
        event.preventDefault();
    } else {
        document.getElementById('messageError').textContent = "";
    }
});