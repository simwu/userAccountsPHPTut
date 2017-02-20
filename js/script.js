// On document ready
$(document).ready(function() {
    // Get all the input tags
    var inputTags = document.querySelectorAll("input");

    // Schedule event handlers for each input tag.
    // Event handlers: On Key Up (after the user types a character)
    // and On Blur (field lost the keyboard focus)
    for(var index = 0; index < inputTags.length; index++) {
        inputTags[index].onkeyup = onKeyUpValidation;
        inputTags[index].onblur  = onBlurValidateRequired;
    }

    // Schedule final validation on form submission by clicking the submit button
    var button = document.getElementById("submit-button");
    button.onclick = onSubmitValidation;
});

/*
 *  OnKeyUp Validation Event Handler
 */

function onKeyUpValidation(event) {
    var p 	 	= this.parentNode.parentNode.querySelector("p");
    var name 	= this.name;
    var valid 	= true;

    // Ignore event as a field gets the focus when tab (9) is pressed,
    // if the field has any data in it. Do not ignore backspace (8); the bs key
    // will erase input data because it's a hardware function.
    var charCode = event.keyCode;

    if (charCode != 9) {

        if (name == "company-name") {
            if (this.value.length > 0 && !companyNameValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "first-name") {
            if (this.value.length > 0 && !nameValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "last-name") {
            if (this.value.length > 0 && !nameValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "dob") {
            if (this.value.length > 0 && !dateCharacterValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "street-address") {
            // Albert-Edward-Peter solution:
            // If the user entered a street address, clear any old error message.
            // Specifically, if Onblur flags this field as an empty required field,
            // we will erase that error message once the user enters some data.
            if (this.value.length > 0) {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "city") {
            if (this.value.length > 0 && !nameValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "zipcode") {
            if (this.value.length > 0 && !numberValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "office-phone") {
            if (this.value.length > 0 && !phoneCharacterValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "user-name") {
            if (this.value.length > 0 && !emailCharacterValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "password") {
            if (this.value.length > 0 && !passwordCharacterValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "card-name") {
            if (this.value.length > 0 && !nameValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "card-number") {
            if (this.value.length > 0 && !cardNumberValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "expiration-date") {
            if (this.value.length > 0 && !dateCharacterValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
        else if (name == "cid") {
            if (this.value.length > 0 && !numberValidation(this)) {
                p.innerHTML = this.getAttribute("title");
                this.style.backgroundColor = "pink";
                this.focus();
                valid = false;
            }
            else {
                p.innerHTML = "";
                this.style.backgroundColor = "white";
                valid = true;
            }
        }
    }

    return valid;
}

/*
 *  OnBlur Validate Event Handler
 */

function onBlurValidateRequired(event) {
    var p 	 	= this.parentNode.parentNode.querySelector("p");
    var name 	= this.name;
    var valid 	= true;

    if (name == "company-name" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "first-name" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "last-name" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "dob") {
        if (this.value.length == 0 && this.className == "required") {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
        else if (this.value.length > 0 && !dateValidation(this)) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "street-address" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "city" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "zipcode" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "office-phone") {
        if (this.value.length == 0 && this.className == "required") {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
        else if (this.value.length > 0 && !phoneValidation(this)) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "user-name") {
        if (this.value.length == 0 && this.className == "required") {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
        else if (this.value.length > 0 && !emailValidation(this)) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "password") {
        if (this.value.length == 0 && this.className == "required") {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
        else if (this.value.length > 0 && !passwordValidation(this)) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "card-name" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "card-number" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "expiration-date" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }
    else if (name == "cid" && this.className == "required") {
        if (this.value.length == 0) {
            p.innerHTML = this.getAttribute("title");
            this.style.backgroundColor = "pink";
            this.focus();
            valid = false;
        }
    }

    return valid;
}

/*
 * On Submit Validation Event Handler
 */

function onSubmitValidation(event) {
    var valid 			  = true;
    var firstInvalidField = -1;
    var input 			  = document.querySelectorAll("input");

    for(var index = 0; index < input.length; index++) {

        var p = input[index].parentNode.parentNode.querySelector("p");

        if (input[index].value.length == 0 && input[index].className == "required") {
            p.innerHTML = input[index].getAttribute("title");
            input[index].style.backgroundColor = "pink";

            if (firstInvalidField == -1) {
                firstInvalidField = index;
            }
        }
        else {
            p.innerHTML = "";
            input[index].style.backgroundColor = "white";
        }
    }

    // Give focus to the first field in error
    if (firstInvalidField != -1) {
        input[firstInvalidField].focus();
        valid = false;
    }

    // Returning false cancels form submission
    return valid;
}

/*
 * Helper Functions
 */

function companyNameValidation(input) {
    var valid = true;
    var characters 	= /^[a-zA-Z0-9 .,&]+$/;		// RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}

function nameValidation(input) {
    var valid = true;
    var characters 	= /^[a-zA-Z .]+$/;			// RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}

function dateCharacterValidation(date) {
    var valid = true;
    var characters 	= /^[\/\d]+$/;				// RegEx: regular expression

    if(!characters.test(date.value)) {
        valid = false;
    }

    return valid;
}

function dateValidation(date) {
    var valid 		= false;
    var shortFormat = /^[\d]{2}\/[\d]{2}\/[\d]{2}$/;	// RegEx: regular expression
    var longFormat 	= /^[\d]{2}\/[\d]{2}\/[\d]{4}$/;	// RegEx: regular expression

    if(shortFormat.test(date.value)) {
        valid = true;
    }
    else if (longFormat.test(date.value)) {
        valid = true;
    }

    return valid;
}

function numberValidation(input) {
    var valid = true;
    var characters 	= /^[0-9]+$/;				        // RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}

function phoneCharacterValidation(input) {
    var valid = true;
    var characters 	= /^[0-9 .()-]+$/;				    // RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}

function phoneValidation(input) {
    var valid  = true;
    var format = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;		// RegEx: regular expression

    if(!format.test(input.value)) {
        valid = false;
    }

    return valid;
}

function emailCharacterValidation(input) {
    var valid 		= true;
    var characters 	= /^[_a-zA-Z0-9-.@]+$/;				// RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}

function emailValidation(input) {
    var valid 		= true;
    var emailformat = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,24})$/;

    if(!emailformat.test(input.value)) {
        valid = false;
    }

    return valid;
}

function passwordCharacterValidation(input) {
    var valid 		= true;
    var characters 	= /^[a-zA-Z0-9_!\W]+$/;			// RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}

function passwordValidation(input) {
    var valid 			= true;
    var passwordformat 	= /^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_!\W]).{8,16})$/;      // RegEx: regular expression

    if(!passwordformat.test(input.value)) {
        valid = false;
    }

    return valid;
}

function cardNumberValidation(input) {
    var valid = true;
    var characters 	= /^[0-9 ]+$/;				// RegEx: regular expression

    if(!characters.test(input.value)) {
        valid = false;
    }

    return valid;
}
