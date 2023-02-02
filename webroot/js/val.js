$(document).ready(function () {
    $('form').submit(function (e) {
        // alert("jisdfvjkdsnjkn")

        //         // Error removing if input is correct/valid
        var removeErr = document.getElementsByClassName('error-message');
        for (i = 0; i < removeErr.length; i++) {
            removeErr[i].innerHTML = "";
        }

        errorcheck = 0;
        var letters = /^[A-Za-z\s]+$/;
        var first_name = $("#user-profile-first-name").val();
        first_name = first_name.trim();
        if (first_name == "") {
            $('#fname-error').html("Please enter your first name");
            errorcheck = 1;
        } else if (!first_name.match(letters)) {
            $('#fname-error').html("Please enter characters only");
            errorcheck = 1;
        } else if (first_name.length < 3) {
            $('#fname-error').html("Please enter at least 3 characters");
            errorcheck = 1;
        }
        var last_name = $("#user-profile-first-name").val();
        last_name = last_name.trim();
        if (last_name == "") {
            $('#lname-error').html("Please enter your first name");
            errorcheck = 1;
        } else if (!last_name.match(letters)) {
            $('#lname-error').html("Please enter characters only");
            errorcheck = 1;
        } else if (last_name.length < 3) {
            $('#lname-error').html("Please enter at least 3 characters");
            errorcheck = 1;
        }
       var  letters = /^[a-z0-9_.]+$/
        var address = $("#user-profile-address").val();
        address = address.trim();
        if (address == "") {
            $('#address-error').html("Please enter your address");
            errorcheck = 1;
        } 
        // email validation
        var validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var email = $("#email").val();
        email = email.trim();
        if (email == null || email == "") {
            $('#email-error').html("Please enter your email");
            errorcheck = 1;
        } else if (!email.match(validRegex)) {
            $('#email-error').html("Please enter valid email");
            errorcheck = 1;
        }

        // phone number validation
        var phone = $("#user-profile-contact").val();
        phone = phone.trim();
        if (phone == "") {
            $('#phone-error').html("Please enter your phone number");
            errorcheck = 1;
        } else if (isNaN(phone)) {
            $('#phone-error').html("Please enter numeric only");
            errorcheck = 1;
        } else if (phone.length != 10) {
            $('#phone-error').html("please enter 10 digit only");
            errorcheck = 1;
        }
        // password validation
        var regularExpressionP = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
        if ($("#password").val() == null) {
            // alert('$("#password").val()')
        } else {
            var password = $("#password").val();
            password = password.trim();
            if (password == "") {
                $('#password-error').html("Please enter your password");
                errorcheck = 1;
            } else if (password.length < 8) {
                $('#password-error').html("please enter at least 8 characters");
                errorcheck = 1;
            } else if (!password.match(regularExpressionP)) {
                $('#password-error').html("password should contain alteast 8 digits, 1 Special Character, one number, 1 uppercase, 1 lowercase");
                errorcheck = 1;
            }

            // confirm password validation
            var cpassword = $("#confirm-password").val();
            cpassword = cpassword.trim();
            if (cpassword == "") {
                $('#confirm-password-error').html("Please enter your confirm password");
                errorcheck = 1;
            } else if (cpassword.length < 8) {
                $('#confirm-password-error').html("please enter at least 8 characters");
                errorcheck = 1;
            } else if (!cpassword.match(regularExpressionP)) {
                $('#confirm-password-error').html("password should contain alteast 8 digits, 1 Special Character, one number, 1 uppercase, 1 lowercase");
                errorcheck = 1;
            } else if (cpassword != password) {
                $('#confirm-password-error').html("confirm password not matched with password");
                errorcheck = 1;
            }
        }
        
        if (errorcheck == 1) {
            return false;
        }

    });


});