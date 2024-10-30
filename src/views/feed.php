<?php
// Connect to Database
require_once __DIR__ . "/../db.php";

// Get last 50 posts
$request = $pdo->prepare(
    "SELECT 
    posts.id AS post_id,
    posts.user_id, 
    posts.content,
    posts.created_at,
    posts.edited_at,
    users.username,
    users.usertag,
    users.useravatar 
    FROM posts
    JOIN users ON posts.user_id = users.id
    ORDER BY posts.created_at DESC
    LIMIT 50");

try {
    $request->execute();
    $posts = $request->fetchAll();
}
catch (PDOException $e) { 
    echo "SQL Error: ". $e->getMessage();
} 
?>
<?php $counter = 0 ?>
<?php foreach ($posts as $post): ?>
<?php $counter += 1 ?>
<div class="ds-tweet-container" id="post_<?= $post['post_id'] ?>" style="opacity: 0;animation-delay: <?=$counter * 0.1?>s;">
  <img class="ds-avatar" src="<?= htmlspecialchars($post['useravatar'])?>" alt="avatar" />
  <div class="ds-tweet-header">
    <?php if(isset($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']): ?>
    <button class="ds-button ds-edit-button edit-post-button" post-id="<?= $post['post_id'] ?>" style="float:right;"><i class="fa-solid fa-pen-to-square"></i></button>
    <?php endif; ?>
    <strong><a class="ds-clickable-text" href="/?page=profile&userid=<?=$post['user_id']?>"><?= htmlspecialchars($post['username']) ?></a></strong> 
    <span>@<?= htmlspecialchars($post['usertag']) ?></span> 
    <span><?= htmlspecialchars($post['created_at']) ?></span>
    <?php if($post['edited_at'] != $post['created_at']): ?>
        <span style="font-size:smaller;">(edited)</span>
    <?php endif; ?>
    <br />
    <p style="opacity: 0;animation-delay: <?=$counter * 0.1?>s;" id="<?= "postContent_" . $post['post_id'] ?>">
    <?= nl2br($post['content']); ?>
    </p>
  </div>
</div>
<?php endforeach; ?>