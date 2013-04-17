/**
 * User: dylan
 * Date: 2013-04-15
 * Time: 12:39 PM
 */

// TODO I'd switch this up, message boxes are so passé
function validateForm() {
//validate userEmail address if it is blank or invalid
    var x = document.forms["createUser"]["userEmail"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    var emailConfirmation = document.getElementById('confirmEmail');
//Display a dialog box indicating if the user has typed an invalid userEmail or null value and let them edit the userEmail.
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        emailConfirmation.className = "label label-important";
        emailConfirmation.innerHTML = "Incompatible Address";
    } else {
        emailConfirmation.className = "label label-success";
        emailConfirmation.innerHTML = "Huzzah";
    }
}


// identify the strength of the password as it is typed
function passwordStrength(password, passwordStrength, errorField) {
    var desc = new Array();
    desc[0] = "Very Weak";
    desc[1] = "Weak";
    desc[2] = "Better";
    desc[3] = "Medium";
    desc[4] = "Strong";
    desc[5] = "Strongest";

    var score = 0;

    //if password bigger than 6 give 1 point
    if (password.length > 6) score++;

    //if password has both lower and uppercase characters give 1 point
    if (( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) )) score++;

    //if password has at least one number give 1 point
    if (password.match(/\d+/)) score++;

    //if password has at least one special caracther give 1 point
    if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) score++;

    //if password bigger than 12 give another 1 point
    if (password.length > 12) score++;

    passwordStrength.innerHTML = desc[score];

    if (score <= 1) {
        passwordStrength.className = "label label-important";
    }

    if (score == 2) {
        passwordStrength.className = "label label-warning";
    }


    if (score == 3) {
        passwordStrength.className = "label label-warning";
    }

    if (score >= 4) {
        passwordStrength.className = "label label-success";
    }


}

function checkPass() {
    //Store the password field objects into variables ...
    var password = document.getElementById('password');
    var rePassword = document.getElementById('rePassword');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field
    //and the confirmation field
    if (password.value == rePassword.value) {
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        rePassword.className = "alert alert-success";
        message.innerHTML = "Passwords Match!";
        message.className = "label label-success";
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        rePassword.className = "alert alert-error";
        message.innerHTML = "Passwords do not match";
        message.className = "label label-important";
    }
}