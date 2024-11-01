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


// Modal post window
// Aquire button
const postButton = document.getElementById('postButton');
if(postButton != null) {
    const postWindowModal = document.getElementById('postWindowModal');
    const closeWindowModal = document.getElementById('newPostWindowCloseButton');

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

// Modal edit profile window
// Aquire button
const buttonEditProfile = document.getElementById('buttonEditProfile');
if(buttonEditProfile != null) {
    const editProfileWindowModal = document.getElementById('editProfileWindowModal');
    const closeWindowModal = document.getElementById('closeProfileEdit');

    // Open modal window when "Edit" is pressed
    buttonEditProfile.addEventListener('click', function()
    {
        editProfileWindowModal.style.display = 'flex';
    });

    // Close modal window when close element is pressed
    closeWindowModal.addEventListener('click', function() {
        editProfileWindowModal.style.display = 'none'; 
    });

    // Close modal window when clicked outside
    window.addEventListener('click', function(event) {
        if(event.target === editProfileWindowModal) {
            editProfileWindowModal.style.display = 'none';
        }
    });
}

// Show avatar preview when chosen file changes
const editAvatarPreview = document.getElementById("editAvatarPreview");
const avatarUpload = document.getElementById('avatarUpload');

if(avatarUpload != null) {
    avatarUpload.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if(file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                editAvatarPreview.src = e.target.result; // set chosen image as preview
            }
            reader.readAsDataURL(file);
        }
    });
}


// Save Profile changes AJAX
const buttonSaveProfile = document.getElementById('buttonSaveProfile');
if(buttonSaveProfile != null) {
    buttonSaveProfile.addEventListener('click', function () {
        newProfileName = document.getElementById('editUsernameTextfield').value;
        newProfileDescription = document.getElementById('editDescriptionTextfield').value;
        newAvatar = document.getElementById('avatarUpload').files[0];

        formData = new FormData();
        formData.append('newProfileName', newProfileName);
        formData.append('newProfileDescription', newProfileDescription);
        
        if(newAvatar) {
            formData.append('newAvatar', newAvatar);
        }

        if(!newProfileName.trim()) {
            alert("Display name can not be empty");
            return;
        }
        fetch("/edit-profile", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById('editProfileWindowModal').style.display = 'none';
                location.reload();
            } else {
                alert(data.message || "Error editing profile.");
            }
        })
        .catch(error => console.error("Error:", error));
    });
}

const homeButton = document.getElementById("homeButton");
if (homeButton != null)
{
    homeButton.addEventListener('click', function() {
        window.location.href="/";
    });
}

// Handle post edit buttons

const postEditButtons = document.querySelectorAll(".edit-post-button");
const postEditWindow = document.getElementById("editPostWindowModal");
const postEditContent = document.getElementById("editPostContent");
const postEditSaveButton = document.getElementById("buttonSavePostChanges");
const postEditWindowCloseButton = document.getElementById("postEditWindowCloseButton");
const postEditDeleteButton = document.getElementById("buttonDeletePost");
let currentPostId;

if(postEditButtons.length > 0)
{
    postEditButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentPostId = button.getAttribute("post-id");
            const currentPostContent = document.getElementById(`postContent_${currentPostId}`).textContent;
            postEditContent.value = currentPostContent.trim();
            postEditWindow.style.display = "block";
        });
    });

    postEditWindowCloseButton.addEventListener('click', function () {
        // Close modal window when close element is pressed
        postEditWindow.style.display = 'none'; 
    });

    // Close modal window when clicked outside
    window.addEventListener('click', function(event) {
        if(event.target === postEditWindow) {
            postEditWindow.style.display = 'none';
        }
    });

    // Post deletion
    postEditDeleteButton.addEventListener('click', function () {
        
        // Ajax post deletion request
        fetch('/edit-post', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify ({postId: currentPostId, deletePost: true})
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // remove post here
                document.getElementById(`post_${currentPostId}`).style.display = 'none';
                postEditWindow.style.display = 'none';
            } else {
                alert(data.message || 'Error occured while deleting post');
            }
        })
        .catch(error => console.error('Error: ', error));
    });

    // Post edit save
    postEditSaveButton.addEventListener('click', function () {
        const newContent = postEditContent.value.trim();
        if(!newContent) {
            alert("Post cannot be empty.");
            return;
        }

        // if no changes do nothing
        if(newContent == document.getElementById(`postContent_${currentPostId}`).textContent.trim())
        {
            postEditWindow.style.display = 'none';
            return;
        }
        // Ajax post edit
        fetch('/edit-post', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify ({postId: currentPostId, content: newContent})
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById(`postContent_${currentPostId}`).innerHTML = newContent.replace(/\n/g, '<br>');
                postEditWindow.style.display = 'none';
            } else {
                alert(data.message || 'Error occured while editing post');
            }
        })
        .catch(error => console.error('Error: ', error));
    });
}
