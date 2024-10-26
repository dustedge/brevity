<DOCTYPE !html>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script defer src="js/ds-common-buttons.js"></script>
<script src="js/bundle.js"></script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div class="flex-container-centered ds-dashed-border" style="flex-direction:row;">

    <div class="flex-container-centered">
        <h1 class="ds-logo-container" id="homeButton">BREVITY</h1>
    </div>
    
    <div class="flex-container-centered" style="align-items:stretch;min-width:20vw">
        <form action="/register-handler" class="flex-container-column" style="justify-content: center;" method="POST" id="signUpForm">
            <h1 style="margin:1vh;">Sign Up:</h1>
            <input class="ds-text-field" id="displayName" name="displayName" type="text" style="margin:1vh;" placeholder="Display Name" required/>
            <input class="ds-text-field" id="login" name="login" type="text" style="margin:1vh;" placeholder="Login" required/>
            <input class="ds-text-field" id="email" name="email" type="email" style="margin:1vh;" placeholder="Hello@to.you" required/>
            <input class="ds-text-field" id="password" name="password" type="password" style="margin:1vh;" placeholder="Password" required/>
            <input class="ds-text-field" id="passwordConfirm" name="passwordConfirm" type="password" style="margin:1vh;" placeholder="Re-type Password" required/>
            <div id="pwdMatchError" style="display:none;">
                <p class="ds-error-text">Passwords must match</p>
            </div>
            <div id="loginFormatError" style="display:none;">
                <p class="ds-error-text">Login can only contain latin characters and numbers</p>
            </div>
            <div id="loginTooShortError" style="display:none;">
                <p class="ds-error-text">Login must contain at least 3 characters</p>
            </div>
            <div class="g-recaptcha" style="width:95%;margin:1vh 1vh;" data-sitekey="6LeQ42wqAAAAAA6wPEaeCQT0U0-i3VDVc22ToQbG" data-callback="enableBtn"></div>
            <div>
                <button class="ds-button" type="submit" value="Submit" style="width:95%;margin:1vh 1vh;" id="buttonRegister" disabled="disabled">Sign Up</button>
            </div>
            <div>
                <p style="display:block;margin:1vh;text-align:center;">Already have an account?</p>
                <a href="/sign-in" style="display:block;margin:1vh;text-align:center;">Sign In</a>
            </div>
        </form>
    </div>
</div>

<script async>
    function enableBtn() {
        document.getElementById("buttonRegister").disabled = false;
    }
</script>

<script>
    document.getElementById("signUpForm").addEventListener("submit", function (event) {
        // check for common errors
        const pwd = document.getElementById("password").value;
        const pwdConfirm = document.getElementById("passwordConfirm").value;
        const pwdMatchError = document.getElementById("pwdMatchError");
        // password retype matching
        if (pwd != pwdConfirm) 
        {
            event.preventDefault();
            pwdMatchError.style.display = "block";
        } else pwdMatchError.style.display = "none";
        
        const login = document.getElementById("login");
        const loginFormatError = document.getElementById("loginFormatError");
        const loginTooShortError = document.getElementById("loginTooShortError");

        // login contains weird characters
        if(!/^[a-zA-Z0-9]+$/.test(login.value)) {
            event.preventDefault();
            loginFormatError.style.display = "block";
        } else loginFormatError.style.display = "none";
        
        // login too short
        if(login.value.length < 3) {
            event.preventDefault();
            loginTooShortError.style.display = "block";
        } else loginTooShortError.style.display = "none";

    });
</script>
</body>
</html>