const createUserForm = document.getElementById("createUserForm");
const formElements = createUserForm.querySelectorAll("input");
const submitButton = document.getElementById("userSubmitBtn");
const formData = {};

formElements.forEach(element => {
    const key = element.id
    if (key) {
        formData[key] = element;
        element.addEventListener("input", validateForm); // calls the form validation function - rename as required
    }
});


function validateForm() {
    let allValid = true;
    formElements.forEach(element => {
        if (!element.value.trim()) {
            allValid = false;
        }

        if (element.type === "email" && !isValidEmail(element.value)) {
            allValid = false;
        }
        if (element.type === "password" && !isMatchingPassword(element.value)) {
            allValid = false;
        }

    });

    submitButton.disabled = !allValid;
    if (submitButton.disabled) {
        submitButton.style.opacity = "0.5";
        submitButton.textContent = "Complete the form to continue";
    }else{
        submitButton.style.opacity = "1";
        submitButton.textContent = "Submit Order";
      //  showTest ? logThis("Submit Button has been activated", true) : null;
    }
}

function isValidEmail(mail) {
    // verify that the email seems valid
    const email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return email.test(mail);
}

function isMatchingPassword(element) {
    const pass = document.getElementById("userCreatePwd"),
          passX = document.getElementById("userCreatePwdX");
    return (pass.value === passX.value);
}

/*
function isValidPhone(phone) {
    // verify that the phone number seems valid
    const num = /^[0-9]{8,12}$/;
    return num.test(phone.replace(/ /g, ""));
}
function testBasketLength() {
    // don't permit submission if basket is empty
    return localStorage.getItem("BASKET");
}
*/
validateForm();