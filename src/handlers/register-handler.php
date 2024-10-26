<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $displayName = htmlspecialchars(trim($_POST['displayName']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['passwordConfirm']);
    $login = htmlspecialchars(trim($_POST['login']));
    $avatar = "/images/avatar-none.png";

    // Recaptcha check. Ignored if no key is provided

    $secretKeyPath = __DIR__ . "/../recaptcha.key";

    if (file_exists($secretKeyPath)) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $secretKey = trim(file_get_contents($secretKeyPath));
        if(!empty($secretKey)) 
        {
            if (empty($recaptchaResponse)) {
                echo "POST: Error. Recaptcha response is missing.";
                exit;
            }
            try {
                // reCAPTCHA API request
                $url = "https://www.google.com/recaptcha/api/siteverify";
                $data = [
                    'secret' => $secretKey,
                    'response' => $recaptchaResponse,
                ];

                // cURL check request
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST,true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curlResponse = curl_exec($ch);
                curl_close($ch); 
                
                $curlResponseData = json_decode($curlResponse);
                
                // reCaptcha Check
                if (!$curlResponseData->success) {
                    echo 'POST: reCAPTCHA Check: Failed.';
                    exit;
                }
            } catch (Exception $e) {
                echo 'POST: reCAPTCHA Check: Error: ' . $e->getMessage();
                exit;
            }
        }
    } else {
        echo "POST: reCaptcha: Key Missing. Ignoring...";
    }

    // Recaptcha check END

    // Password matching check
    if($password != $passwordConfirm) {
        echo "POST: Error. Passwords don't match.";
        exit;
    }

    // Email validation check
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "POST: Error. Failed to validate email.";
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // connect to db
    require_once __DIR__ . '/../db.php';


    // check if user with same email or usertag exists
    $check = $pdo->prepare("SELECT * FROM users WHERE email = :email OR usertag = :login LIMIT 1");
    $check->bindParam(":email", $email);
    $check->bindParam(":login", $login);
    try {
        $check->execute();
        $checkuser = $check->fetch();
        if($checkuser) {
            echo "POST: Error. Email or User name is already taken.";
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
