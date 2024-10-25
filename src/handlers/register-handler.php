<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $displayName = htmlspecialchars(trim($_POST['displayName']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['passwordConfirm']);
    $login = htmlspecialchars(trim($_POST['login']));
    $avatar = "/images/avatar-none.png";

    if($password != $passwordConfirm) {
        echo "POST: Error. Passwords don't match.";
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "POST: Error. Failed to validate email.";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // connect to db
    require_once __DIR__ . '/../db.php';


    // check if user with same email exists
    $check = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $check->bindParam(":email", $email);
    try {
        $check->execute();
        $checkuser = $check->fetch();
        if($checkuser) {
            echo "POST: Error. Email taken.";
            exit;
        }
    }
    catch(PDOException $e) {
        echo "POST: SQL Query Error: " . $e->getMessage();
        exit;
    }

    // prepare register query
    $stmt = $pdo->prepare("INSERT INTO users (username, usertag, email, password, useravatar) VALUES (:displayName, :login, :email, :password, :useravatar)");
    $stmt->bindParam(':displayName', $displayName);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':useravatar', $avatar);

    try {
        $stmt->execute();
        // echo "POST: Registration successful";
        header("Location: /welcome-new");
    }
    catch(PDOException $e) {
        echo "POST: Registration error: ". $e->getMessage();
    }

} else {
    // If method is not post redirect
    header("Location: /register");
    exit;
}
