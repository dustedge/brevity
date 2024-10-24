<DOCTYPE !html>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<script src="js/bundle.js"></script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
  <div id="postWindowModal" class="ds-modal">
    <div class="ds-modal-content">
      <div>
        <h2 style="display:inline;float:left;">Post new message:</h2> <span class="close">&times;</span>
      </div>
      <textarea class="ds-post-content ds-dashed-border"></textarea>
      <div>
        <button class="ds-button" id="addNewPostButton">POST</button>
      </div>
    </div>
  </div>

  <div class="flex-container">

    <div class="ds-sidebar-left">
      <div class="ds-logo-container" id="homeButton">
        <h1 style="text-align:center;color:white;">BREVITY</h1>
      </div>
      <div class="ds-nav-container">
        <button class="ds-nav-button">FEED</button>
        <button class="ds-nav-button" id="buttonUserProfile">PROFILE</button>
        <button class="ds-nav-button" id="postButton">POST</button>
        <button class="ds-nav-button ds-bottom-fixed" id="buttonSignIn">SIGN-IN</button>
        <button class="ds-nav-button ds-bottom-fixed" id="buttonLogout" style="display:none;">Logout</button> <!--HIDDEN-->
      </div>
    </div>

    <div class="ds-feed">

      <div class="ds-tweet-container">
        <img class="ds-avatar" src="icon-large.png" alt="avatar" />
        <div class="ds-tweet-header">
          <strong>Ivan Navi</strong> <span>@ivannavi123</span> <span>21 Oct</span>
          <br />
          <p>
          The big brown fox jumped over the lazy dog. Ahahoy. Join Bebra Incorporated today. <a href="#Bebra">#Bebra</a>
          </p>
        </div>
      </div>

      <div class="ds-tweet-container">
        <img class="ds-avatar" src="icon-large.png" alt="avatar" />
        <div class="ds-tweet-header">
          <strong>TheHeyaya</strong> <span>@hezerg</span> <span>20 Oct</span>
          <br />
          <p>
          It's gonna be fire 🔥🔥🔥🔥🔥🔥 
          </p>
        </div>
      </div>

      <div class="ds-tweet-container">
        <img class="ds-avatar" src="icon-large.png" alt="avatar" />
        <div class="ds-tweet-header">
          <strong>Fireboys</strong> <span>@ilosass</span> <span>19 Oct</span>
          <br />
          <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat purus non lorem maximus, a auctor ligula gravida. Proin lacus felis, bibendum nec iaculis vitae, elementum id dui. Vestibulum dolor ante, lacinia eget sem sed, fringilla congue mi. Etiam elit ante, pulvinar eget tortor consectetur, ullamcorper hendrerit massa. Vestibulum luctus enim a commodo mattis. In facilisis posuere mauris quis feugiat. Curabitur felis quam, porttitor ultricies blandit in, rhoncus nec dolor. Nullam tempus pharetra nunc, ut interdum lectus sodales eget. Maecenas id tincidunt justo.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat purus non lorem maximus, a auctor ligula gravida. Proin lacus felis, bibendum nec iaculis vitae, elementum id dui. Vestibulum dolor ante, lacinia eget sem sed, fringilla congue mi. Etiam elit ante, pulvinar eget tortor consectetur, ullamcorper hendrerit massa. Vestibulum luctus enim a commodo mattis. In facilisis posuere mauris quis feugiat. Curabitur felis quam, porttitor ultricies blandit in, rhoncus nec dolor. Nullam tempus pharetra nunc, ut interdum lectus sodales eget. Maecenas id tincidunt justo.
          </p>
        </div>
      </div>

      <div class="ds-tweet-container">
        <img class="ds-avatar" src="icon-large.png" alt="avatar" />
        <div class="ds-tweet-header">
          <strong>Gorevandal</strong> <span>@grv_xxx</span> <span>18 Oct</span>
          <br />
          <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat purus non lorem maximus, a auctor ligula gravida. Proin lacus felis, bibendum nec iaculis vitae, elementum id dui. Vestibulum dolor ante, lacinia eget sem sed, fringilla congue mi. Etiam elit ante, pulvinar eget tortor consectetur, ullamcorper hendrerit massa. Vestibulum luctus enim a commodo mattis. In facilisis posuere mauris quis feugiat. Curabitur felis quam, porttitor ultricies blandit in, rhoncus nec dolor. Nullam tempus pharetra nunc, ut interdum lectus sodales eget. Maecenas id tincidunt justo.
          </p>
        </div>
      </div>

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
  <script src="js/ds-common-buttons.js"></script>
</body>
</html>