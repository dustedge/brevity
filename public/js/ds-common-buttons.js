// Common button functionality

buttonSignIn = document.getElementById("buttonSignIn");

if(buttonSignIn != null) {
    buttonSignIn.addEventListener('click', function() {
        window.location.href = "/sign-in";
    });
}

buttonLogout = document.getElementById("buttonLogout");

if(buttonLogout != null) {
    buttonLogout.addEventListener('click', function() {
        window.location.href = "/logout";
    });
}

buttonLogout = document.getElementById("buttonFeed");

if(buttonLogout != null) {
    buttonLogout.addEventListener('click', function() {
        window.location.href = "/?page=feed";
    });
}

buttonUserProfile = document.getElementById("buttonUserProfile");

if(buttonUserProfile != null) {
    buttonUserProfile.addEventListener('click', function() {
        window.location.href = "/?page=profile";
    });
}

// Modal post button
// Aquire button
const postButton = document.getElementById('postButton');
if(postButton != null) {
    const postWindowModal = document.getElementById('postWindowModal');
    const closeWindowModal = document.querySelector('.close');

    // Open modal window when "Post" is pressed
    postButton.addEventListener('click', function()
    {
        postWindowModal.style.display = 'block';
    });

    // Close modal window when close element is pressed
    closeWindowModal.addEventListener('click', function() {
        postWindowModal.style.display = 'none'; 
    });

    // Close modal window when clicked outside
    window.addEventListener('click', function(event) {
        if(event.target === postWindowModal) {
            postWindowModal.style.display = 'none';
        }
    });
}

const homeButton = document.getElementById("homeButton");
if (homeButton != null)
{
    homeButton.addEventListener('click', function() {
        window.location.href="/";
    });
}