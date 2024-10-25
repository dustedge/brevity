<DOCTYPE !html>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<script src="js/bundle.js"></script>
<script defer src="js/ds-common-buttons.js"></script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div class="flex-container-centered ds-dashed-border" style="flex-direction:row;">

    <div class="flex-container-centered">
        <h1 class="ds-logo-container"  id="homeButton">BREVITY</h1>
    </div>
    
    <div class="flex-container-centered" style="align-items:stretch;">
        <form id="signInForm" action="/sign-in-handler" method="POST">
            <div>
                <h1 style="margin:1vh;">Sign In:</h1>
            </div>
            <div>
                <input class="ds-text-field" type="email" name="email" id="email" style="margin:1vh;" placeholder="Hello@to.you" required/>
            </div>
            <div>
                <input class="ds-text-field" type="password" name="password" id="password" style="margin:1vh;" placeholder="Password" required/>
            </div>
            <div> 
                <p class="ds-error-text" style="display: none;" id="errorMessage"></p>
            </div>
            <div>
                <button class="ds-button" type="submit" value="Submit" style="width:95%;margin:1vh 1vh;" id="buttonLogin"><h3 style="font-size:100%;">Sign In</h3></button>
            </div>
        </form>
        <div>
            <p style="display:block;margin:1vh;text-align:center;">Don't have an account?</p>
            <a href="/register" style="display:block;margin:1vh;text-align:center;">Sign Up</a>
        </div>
    </div>
</div>
<script>
    // AJAX Form handling
    document.getElementById("signInForm").addEventListener('submit', function (e) {
        // stop submitting
        e.preventDefault();
        const formData = new FormData(this);

        const errorMessage = document.getElementById("errorMessage");

        // send request
        fetch("/sign-in-handler", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // display error text if error
            if(data.success === false) {
                errorMessage.style.display = 'block';
                errorMessage.innerText = data.message;
            } else {
                // transfer to user profile page
                window.location.href = "/user";
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>