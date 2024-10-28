// Common button functionality

const buttonSignIn = document.getElementById("buttonSignIn");

if(buttonSignIn != null) {
    buttonSignIn.addEventListener('click', function() {
        window.location.href = "/sign-in";
    });
}

const buttonLogout = document.getElementById("buttonLogout");

if(buttonLogout != null) {
    buttonLogout.addEventListener('click', function() {
        window.location.href = "/logout";
    });
}

const buttonFeed = document.getElementById("buttonFeed");

if(buttonFeed != null) {
    buttonFeed.addEventListener('click', function() {
        window.location.href = "/?page=feed";
    });
}

const buttonUserProfile = document.getElementById("buttonUserProfile");

if(buttonUserProfile != null) {
    buttonUserProfile.addEventListener('click', function() {
        window.location.href = "/?page=profile";
    });
}

const buttonAddNewPost = document.getElementById("buttonAddNewPost");

if(buttonAddNewPost != null) {
    buttonAddNewPost.addEventListener('click', function() {
        newPostContent = document.getElementById("newPostContent").value;

        // if new post is empty return
        if(!newPostContent.trim()) {
            return;
        }

        // AJAX logic
        fetch("/add-post", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ newPostContent })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById('postWindowModal').style.display = 'none';
                location.reload();
            } else {
                alert(data.message || "Error adding post.");
            }
        })
        .catch(error => console.error("Error:", error));
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