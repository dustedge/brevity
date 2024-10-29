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
$newProfileName = htmlspecialchars(trim($_POST['newProfileName'] ?? ''));
$newProfileDescription = htmlspecialchars(trim($_POST['newProfileDescription'] ?? ''));
$avatarUrl = "";

if(empty($newProfileName)) {
    echo json_encode(['success'=> false,'message'=> 'Display name is empty.']);
    exit;
}

// avatar check ------------ TO-DO: Proper file validation.
if (isset($_FILES['newAvatar']) && $_FILES['newAvatar']['error'] === UPLOAD_ERR_OK) {
    $avatarTmpPath = $_FILES['newAvatar']['tmp_name'];
    $avatarName = uniqid() . "-" . $_FILES['newAvatar']['name'];
    $uploadDir = __DIR__ . '/../../public/uploads/';
    $avatarPath = $uploadDir . $avatarName;

    // move uploaded file to uploads
    if (move_uploaded_file($avatarTmpPath, $avatarPath)) {
        $avatarUrl = "/uploads/" . $avatarName;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload avatar.']);
        exit;
    }
}

require_once(__DIR__ .'/../db.php'); // connect to db;

// Update user data
try {
    $sql = 'UPDATE users SET username = :username, userdescription = :userdescription';
    if($avatarUrl){
        $sql .= ", useravatar = :avatar";
    }
    $sql .= ' WHERE id = :user_id';

    $request = $pdo->prepare($sql);
    $request->bindParam(':username', $newProfileName);
    $request->bindParam(':user_id', $_SESSION['user_id']);
    $request->bindParam(':userdescription', $newProfileDescription);

    if($avatarUrl) {
        $request->bindParam(':avatar', $avatarUrl);
    }

    $request->execute();
    echo json_encode(['success'=> true]);
    $_SESSION['user_avatar'] = $avatarUrl;
} catch (PDOException $e) {
    echo json_encode(['success'=> false,'message'=> 'SQL Error occured:' . $e->getMessage()]);
}