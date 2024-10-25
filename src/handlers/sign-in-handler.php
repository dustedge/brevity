<?php
// Header for AJAX
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)) {
        echo "POST: Error. Empty fields present.";
    }

    require_once __DIR__ . "/../db.php";
    $stmt = $pdo->prepare(
        "select * from users where email = :email LIMIT 1");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if($user) {
        // verify password
        if(password_verify($password, $user["password"])) {
            // success
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["username"];
            $_SESSION["user_tag"] = $user["usertag"];
            $_SESSION["user_avatar"] = $user["useravatar"];
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Wrong password.']);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'User does not exist.']);
        exit;
    }
} else {
    header("Location: /sign-in");
    exit;
}