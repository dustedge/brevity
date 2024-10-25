<DOCTYPE !html>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<script src="js/bundle.js"></script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div class="flex-container-centered ds-dashed-border" style="flex-direction:row;">

    <div class="flex-container-centered">
        <h1 class="ds-logo-container"  id="homeButton">BREVITY</h1>
    </div>
    
    <div class="flex-container-centered" style="align-items:stretch;">
        <form action="/sign-in-handler" method="POST">
            <div>
                <h1 style="margin:1vh;">Sign In:</h1>
            </div>
            <div>
                <input class="ds-text-field" type="email" style="margin:1vh;" placeholder="Hello@to.you" required/>
            </div>
            <div>
                <input class="ds-text-field" type="password" style="margin:1vh;" placeholder="Password" required/>
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
<script src="js/ds-common-buttons.js"></script>
</body>
</html>