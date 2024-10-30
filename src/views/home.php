<?php
session_start();
$page = isset($_GET["page"]) ? $_GET["page"] : "feed";
$page_user_id = isset($_GET["userid"]) ? $_GET["userid"] : NULL;
?>

<DOCTYPE !html>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
<link rel="manifest" href="/site.webmanifest" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
  <script src="js/bundle.js"></script>
  <script defer src="js/ds-common-buttons.js"></script>
  <?php if(isset($_SESSION["user_id"])): // ADD MODAL WINDOWS IF USER IS LOGGED IN?>
    <div id="postWindowModal" class="ds-modal">
      <form id="newPostForm">
        <div class="ds-modal-content">
          <div>
            <h2 style="display:inline;float:left;">Post new message:</h2> <span id="newPostWindowCloseButton" class="close">&times;</span>
          </div>
          <textarea class="ds-post-content ds-dashed-border" id="newPostContent" placeholder="What's happening?" required></textarea>
          <div>
            <button type="button" class="ds-button" id="buttonAddNewPost"><i class="fa-solid fa-message"></i> POST</button>
          </div>
        </div>
      </form>
    </div>

    <div id="editPostWindowModal" class="ds-modal">
      <form id="editPostForm">
        <div class="ds-modal-content">
          <div>
            <h2 style="display:inline;float:left;">Edit message:</h2> <span id="postEditWindowCloseButton" class="close">&times;</span>
          </div>
          <textarea class="ds-post-content ds-dashed-border" id="editPostContent" placeholder="What's happening?" required></textarea>
          <div>
            <button type="button" class="ds-button ds-error-text" style="display:inline; width:40%;" id="buttonDeletePost"> <i class="fa-solid fa-trash"></i> Delete Post</button>
            <button type="button" class="ds-button" style="display:inline; width:40%;" id="buttonSavePostChanges"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <div class="flex-container">

    <div class="ds-sidebar-left">
      <div class="ds-logo-container" id="homeButton">
        <h1 style="text-align:center;color:white;"><i class="fa-solid fa-radio"></i> BREVITY</h1>
      </div>
      <div class="ds-nav-container">
        <button class="ds-nav-button" id="buttonFeed"><i class="fa-solid fa-rss"></i> FEED</button>
        <?php if (!isset($_SESSION['user_id'])): ?>
        <button class="ds-nav-button ds-bottom-fixed" id="buttonSignIn"> <i class="fa-solid fa-right-to-bracket"></i> SIGN IN</button>
        <?php else: ?>
        <button class="ds-nav-button" id="buttonUserProfile"> <i class="fa-regular fa-address-card"></i> PROFILE</button>
        <button class="ds-nav-button" id="postButton"><i class="fa-solid fa-comment"></i> POST</button>
        <div style="margin:1vh;">
          <img class="ds-avatar" style="float:left;" src="<?php echo $_SESSION['user_avatar']; ?>"/>
          Logged in as: <br /> 
          <a href="/?page=profile" style="text-decoration: none;"><strong class="ds-clickable-text"> <?php echo $_SESSION['user_name']; ?> </strong></a>
          <p class="ds-context-text">@<?php echo $_SESSION['user_tag']; ?></p>
        </div>
        <button class="ds-nav-button ds-bottom-fixed" id="buttonLogout"><i class="fa-solid fa-right-from-bracket"></i> LOG OUT</button>
        <?php endif; ?>
        
      </div>
    </div>

    <div class="ds-feed" id="feed">
      <!--ADD FEED HERE. EXAMPLE TWEET: -->
      <?php 
        if($page == "feed") {
          require __DIR__ . "/feed.php";
        } else if($page == "profile") {
          require __DIR__ . "/userprofile.php";
        }
      ?>
    </div>

    <div class="ds-sidebar-right">
      <div class="flex-container-column ds-dashed-border">
        <h1 style="text-align:center;">Trending</h1>
        
        <div class="ds-hashtag-holder">
          <hr>
          <a href="#Bebra">#Bebra</a>
          <br/>20 posts
        </div>

        <div class="ds-hashtag-holder">
          <hr>
          <a href="#Pebins">#Pebins</a>
          <br/>14 posts
        </div>

        <div class="ds-hashtag-holder">
          <hr>
          <a href="#eee">#eee</a>
          <br/>3 posts
        </div>

      </div>
    </div>
  </div>
  
</body>
</html>