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
$content = htmlspecialchars(trim($data['newPostContent'] ?? ''));

if(empty($content)) {
    echo json_encode(['success'=> false,'message'=> 'Content is empty.']);
    exit;
}

require_once(__DIR__ .'/../db.php'); // connect to db;

try {
    $stmt = $pdo->prepare('INSERT INTO posts 
    (user_id, content) VALUES (:user_id, :content)');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':content', $content);
    $stmt->execute();
    echo json_encode(['success'=> true]);
} catch (PDOException $e) {
    echo json_encode(['success'=> false,'message'=> 'SQL Error occured.']);
}