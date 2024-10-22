// Aquire button
const postButton = document.getElementById('postButton');
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