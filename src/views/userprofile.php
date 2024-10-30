<?php
// if logged in + no &userid provided by GET or &userid === self
$editable = false;
if (isset($_SESSION['user_id']) && ($page_user_id == NULL || $page_user_id == $_SESSION['user_id'])) {
    $editable = true;
    $page_user_id = $_SESSION['user_id'];
    // select * from posts where user_id = $_SESSION['user_id'] order by created_at desc limit 50
}
// if no SESSION is present just display the page of user id provided.
elseif (!isset($_SESSION['user_id'])) {
    $editable = false;
    // DON'T FORGET TO HANDLE NONEXISTANT USERS
}

require_once(__DIR__ . '/../db.php'); // include database

// get info about target user
$request = $pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
$request->bindParam(':id', $page_user_id);
unset($result);

try {
    $request->execute();
    $result = $request->fetch();
    if(empty($result)) {
        header('Location: /');
    }
}
catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

// get users posts

$request = $pdo->prepare('SELECT posts.id AS post_id, 
posts.*, 
users.username, 
users.usertag, 
users.useravatar,
users.userdescription
FROM posts 
JOIN users 
ON users.id = posts.user_id
WHERE users.id = :page_user_id
ORDER BY posts.created_at DESC
LIMIT 50');
$request->bindParam(':page_user_id', $page_user_id);

unset($posts);

try {
    $request->execute();
    $posts = $request->fetchAll();
}
catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

?>

<?php if($editable): // Add profile edit modal window to html if profile is editable?>
<div class="ds-modal" id="editProfileWindowModal">
    <div class="ds-modal-content ds-dashed-border" style="height:70vh;">
        <form id="editProfileForm" style="display:flex; flex-direction:column; flex-grow:1; justify-content:space-between;">
            <div class="ds-userprofile-content">
                <div style="display:inline;">
                    <img id="editAvatarPreview" class="ds-userprofile-avatar ds-dashed-border" style="position:relative;left:-1vw;" src="<?= $result['useravatar'] ?>">
                    <label for="avatarUpload" class="ds-button ds-edit-button" style="float:none;position:relative; top: 75%; left: -44%;"><i class="fa-solid fa-upload"></i></label>
                    <input type="file" id="avatarUpload" name="avatarUpload" accept="image/*" style="display:none;" />
                </div>
                
                <div>
                    <span class="close" id="closeProfileEdit" style="float:right;">&times;</span>
                    <input id="editUsernameTextfield" class="ds-text-field" style="display:block; width:60%; font-size:medium;" type="text" value="<?= $result['username'] ?>" style="font-weight:bold;font-size:large" required />
                </div>
                <span class="ds-context-text" style="float:left;">@<?= $result['usertag'] ?></span>
                <span class="ds-context-text" style="float:right"> Member since: <?= date("d-m-Y",strtotime($result['created_at'])) ?> </span>
                
            </div>
            <div style="display:flex;">
                <textarea class="ds-post-content" id="editDescriptionTextfield" style="height:25vh;" placeholder="Description"><?= $result['userdescription'] ?></textarea>
            </div>
            <div>
                <button type="button" class="ds-button ds-bottom-fixed" id="buttonSaveProfile"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="ds-userprofile-container ds-dashed-border">
    <div>
        <img class="ds-userprofile-avatar" src="<?= $result['useravatar'] ?>"/>
        <?php if($editable): ?>
        <button class="ds-button ds-edit-button" id="buttonEditProfile"><i class="fa-solid fa-pen-to-square"></i></button>
        <?php endif; ?>
    </div>
    <div class="ds-userprofile-content">
    
    <strong class="ds-clickable-text" style="font-size:large"><?= $result['username'] ?></strong>
    <br />
    <span> @<?= $result['usertag'] ?> </span>
    <span style="float:right"> Member since: <?= date("d-m-Y",strtotime($result['created_at'])) ?> </span>
    <br />
    <p style="line-height:2em;"> <?= nl2br($result['userdescription']); ?> </p>
    </div>
</div>
<h2 class="ds-clickable-text" style="margin:1vh;">POSTS:</h2>

    <!--DRAW POSTS-->

<?php foreach ($posts as $post): ?>
<div class="ds-tweet-container" id="post_<?= $post['id'] ?>">
  <img class="ds-avatar" src="<?= htmlspecialchars($post['useravatar'])?>" alt="avatar" />
  <div class="ds-tweet-header">
    <?php if(isset($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']): ?>
    <button class="ds-button ds-edit-button edit-post-button" post-id="<?= $post['id'] ?>" style="float:right;"><i class="fa-solid fa-pen-to-square"></i></button>
    <?php endif; ?>
    <strong><a class="ds-clickable-text" href="/?page=profile&userid=<?=$post['user_id']?>"><?= htmlspecialchars($post['username']) ?></a></strong> 
    <span>@<?= htmlspecialchars($post['usertag']) ?></span> 
    <span><?= htmlspecialchars($post['created_at']) ?></span>
    <?php if($post['edited_at'] != $post['created_at']): ?>
        <span style="font-size:smaller;">(edited)</span>
    <?php endif; ?>
    <br />
    <p id="<?= "postContent_" . $post['id'] ?>">
    <?= nl2br($post['content']); ?>
    </p>
  </div>
</div>
<?php endforeach; ?>