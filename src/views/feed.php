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

<?php foreach ($posts as $post): ?>
<div class="ds-tweet-container">
  <img class="ds-avatar" src="<?= htmlspecialchars($post['useravatar'])?>" alt="avatar" />
  <div class="ds-tweet-header">
    <strong><a class="ds-clickable-text" href="/?page=profile&userid=<?=$post['user_id']?>"><?= htmlspecialchars($post['username']) ?></a></strong> 
    <span>@<?= htmlspecialchars($post['usertag']) ?></span> 
    <span><?= htmlspecialchars($post['created_at']) ?></span>
    <br />
    <p>
    <?= $post['content'] ?>
    </p>
  </div>
</div>
<?php endforeach; ?>