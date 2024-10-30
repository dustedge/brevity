<?php 
session_start();
header('Content-Type: application/json');

// Session check
if(!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User is not logged in.']);
    exit;
}

// Retrieving request data 
unset($data);
$data = json_decode(file_get_contents('php://input'), true);
$content = htmlspecialchars(trim($data['content'] ?? ''));
$postId = $data['postId'] ?? null;
$deletePost = $data['deletePost'] ?? false;


// Data check

if(empty($postId)) {
    echo json_encode(['success'=> false,'message'=> 'Required fields are empty.']);
    exit;
}

// Connect to db
require_once __DIR__ . '/../db.php';


// Post deletion
if($deletePost) {
    try {
        $request = $pdo->prepare('DELETE FROM posts
        WHERE id = :post_id 
        AND user_id = :user_id');
        $request->bindParam(':post_id', $postId);
        $request->bindParam(':user_id', $_SESSION['user_id']);
        $request->execute();
        echo json_encode(['success'=> true]);
    } catch (PDOException $e) {
        echo json_encode(['success'=> false,'message'=> $e->getMessage()]);
    }
    exit;
} else {
    try {
        $request = $pdo->prepare('UPDATE posts 
        SET content = :content, 
        edited_at = NOW() 
        WHERE id = :post_id 
        AND user_id = :user_id');
        $request->bindParam(':content', $content);
        $request->bindParam(':post_id', $postId);
        $request->bindParam(':user_id', $_SESSION['user_id']);

        $request->execute();
        echo json_encode(['success'=> true]);
    } catch (PDOException $e) {
        echo json_encode(['success'=> false,'message'=> $e->getMessage()]);
    }
    exit;
}