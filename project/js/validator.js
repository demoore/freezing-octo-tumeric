/**
 * User: dylan
 * Date: 2013-04-15
 * Time: 12:39 PM
 */

// TODO I'd switch this up, message boxes are so passé
function validateForm() {
//validate userEmail address if it is blank or invalid
    var x = document.forms["fillOut"]["userEmail"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
//Display a dialog box indicating if the user has typed an invalid userEmail or null value and let them edit the userEmail.
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        alert("Null or invalid userEmail address entered please try again");
        return false;
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
    passwordStrength.className = "strength" + score;
}

$(document).ready(function () {
    $('#createUser').validate({
        rules: {
            firstName: "required",
            userEmail: {
                required: true,
                userEmail: true
            },
            rePassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages: {
            firstName: "Please enter your first name",
            userEmail: "Please provide an email",
            rePassword: {
                required: "You need to provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Your password does not match"
            }
        }
    });
});