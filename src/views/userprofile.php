<?php
// if logged in + no &userid provided by GET or &userid === self
$editable = false;
if (isset($_SESSION['user_id']) && ($page_user_id == NULL || $page_user_id == $_SESSION['user_id'])) {
    $editable = true;
    // DISPLAY PROFILE OF SELF + EDITABLE
}
// if no SESSION is present just display the page of user id provided.
elseif (!isset($_SESSION['user_id'])) {
    $editable = false;
    // DON'T FORGET TO HANDLE NONEXISTANT USERS
}
?>

<div class="ds-userprofile-container ds-dashed-border">
    <img class="ds-userprofile-avatar" src="images/avatar-none.png"/>
    <div class="ds-userprofile-content">
    <button class="ds-button ds-edit-button">✏️</button>
    <strong class="ds-clickable-text" style="font-size:large">User name</strong>
    <br />
    <span>@usertag</span>
    <br />
    <p>User description. text of text text of text text of text text of text text of text text of text</p>
    </div>
</div>
<h2 class="ds-clickable-text" style="margin:1vh;">POSTS:</h2>

<?php require __DIR__ . "/feed.php" ?>