// Homepage button functionality

buttonSignIn = document.getElementById("buttonSignIn");

buttonSignIn.addEventListener('click', function() {
    window.location.href = "/sign-in";
});

buttonLogout = document.getElementById("buttonLogout");

buttonLogout.addEventListener('click', function() {
    window.location.href = "/logout";
});

buttonUserProfile = document.getElementById("buttonUserProfile");

buttonUserProfile.addEventListener('click', function() {
    window.location.href = "/user";
});

