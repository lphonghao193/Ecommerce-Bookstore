document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.querySelector("input[name='email']");
    const usernameInput = document.querySelector("input[name='username']");
    const passwordInput = document.querySelector("input[name='password']");
    const confirmPasswordInput = document.querySelector("input[name='confirm-password']");

    const usernameFeedback = document.getElementById("username-feedback");
    const passwordFeedbackCont = document.getElementById("password-feedback");
    const confirmPasswordFeedback = document.getElementById("confirm-password-feedback");
    const emailFeedback = document.getElementById("email-feedback");

    let isUsernameValid = false;
    let isEmailValid = false;
    let isPasswordValid = false;
    let isConfirmPasswordValid = false;
    const submitButton = document.querySelector("input[type='submit']");
    submitButton.disabled = true;

    function checkFormValidity() {
        const isFormValid = isUsernameValid && isPasswordValid && isConfirmPasswordValid && isEmailValid;

        submitButton.disabled = !isFormValid;

        if (submitButton.disabled) {
            submitButton.value = "Sign Up (Disabled)";
        } else {
            submitButton.value = "Sign Up";
        }
    }


    async function postData(data) {
        const response = await fetch("./app/controllers/SignUpValidation.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams(data)
        });
        return await response.text();
    }

    // Username
    usernameInput.addEventListener("input", async function () {
        const username = usernameInput.value.trim();
        const usernameRegex = /^[a-zA-Z0-9._-]{6,30}$/;

        if (username === "") {
            usernameFeedback.innerHTML = "";
            isUsernameValid = false;
        } else if (!usernameRegex.test(username)) {
            usernameFeedback.innerHTML = "Username must be 6-30 characters and only include letters, numbers, dots (.), underscores (_), and hyphens (-)";
            usernameFeedback.style.color = "red";
            isUsernameValid = false;
        } else {
            const result = await postData({ username });
            usernameFeedback.innerHTML = result;
            usernameFeedback.style.color = "red";
            isUsernameValid = result === "";
        }
        checkFormValidity();
    });

    // Email
    emailInput.addEventListener("input", async function () {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email === "") {
            emailFeedback.innerHTML = "";
            isEmailValid = false;
        } else if (!emailRegex.test(email)) {
            emailFeedback.innerHTML = "Invalid email format";
            emailFeedback.style.color = "red";
            isEmailValid = false;
        } else {
            const result = await postData({ email });
            emailFeedback.innerHTML = result;
            emailFeedback.style.color = "red";
            isEmailValid = result === "";
        }
        checkFormValidity();
    });

    // Password
    passwordInput.addEventListener("input", async function () {
        const password = passwordInput.value;
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d\S]{6,}$/;

        if (password === "") {
            passwordFeedbackCont.innerHTML = "";
            passwordFeedbackCont.style.display = "none";
            isPasswordValid = false;
        } else if (!passwordRegex.test(password)) {
            passwordFeedbackCont.innerHTML = "Password must be at least 6 characters long and include a letter, number, and special character.";
            passwordFeedbackCont.style.color = "red";
            passwordFeedbackCont.style.display = "block";
            isPasswordValid = false;
        } else {
            const result = await postData({ password });
            if (result === "Valid password.") {
                passwordFeedbackCont.innerHTML = "";
                passwordFeedbackCont.style.display = "none";
                isPasswordValid = true;
            } else {
                passwordFeedbackCont.innerHTML = result;
                passwordFeedbackCont.style.color = "red";
                passwordFeedbackCont.style.display = "block";
                isPasswordValid = false;
            }
        }
        checkFormValidity();
    });

    // Confirm password
    confirmPasswordInput.addEventListener("input", function () {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (confirmPassword === "") {
            confirmPasswordFeedback.innerHTML = "";
            isConfirmPasswordValid = false;
        } else if (password !== confirmPassword) {
            confirmPasswordFeedback.innerHTML = "Passwords do not match!";
            confirmPasswordFeedback.style.color = "red";
            isConfirmPasswordValid = false;
        } else {
            confirmPasswordFeedback.innerHTML = "";
            isConfirmPasswordValid = true;
        }
        checkFormValidity();
    });
});
