<?php
ini_set('display_errors', 1);           // dev error report
ini_set('display_startup_errors', 1);   // dev error report
error_reporting(E_ALL);                   // dev error report

// require_once __DIR__ . '/../vendor/autoload.php'; // composer stuff TO-DO

// routing logic
$requestUri = $_SERVER["REQUEST_URI"];

// remove /public from requesturi
$requestUri = str_replace("/public", "", $requestUri);
// remove params if present
$requestUri = strtok($requestUri,"?");

if ($requestUri === "/register") {
  require __DIR__ . "/../src/views/register.php";
} elseif ($requestUri === "/sign-in" || $requestUri === "/login") {
  require __DIR__ . "/../src/views/signin.php";
} elseif ($requestUri === "/home" || $requestUri === "/") {
  require __DIR__ . "/../src/views/home.php";
} elseif ($requestUri === "/user") {
  require __DIR__ . "/../src/views/userprofile.php";
} elseif ($requestUri === "/register-handler" && $_SERVER["REQUEST_METHOD"] === "POST") {
  require __DIR__ . "/../src/handlers/register-handler.php";
} elseif ($requestUri === "/sign-in-handler" && $_SERVER["REQUEST_METHOD"] === "POST") {
  require __DIR__ . "/../src/handlers/sign-in-handler.php";
} elseif ($requestUri === "/welcome-new") {
  require __DIR__ . "/../src/views/register-success.php";
} elseif ($requestUri === "/logout") {
  require __DIR__ . "/../src/handlers/logout.php";
} elseif ($requestUri === "/add-post" && $_SERVER["REQUEST_METHOD"] === "POST") {
  require __DIR__ . "/../src/handlers/post-handler.php";
} elseif ($requestUri === "/edit-profile" && $_SERVER["REQUEST_METHOD"] === "POST") {
  require __DIR__ . "/../src/handlers/edit-profile-handler.php";
} elseif ($requestUri === "/edit-post" && $_SERVER["REQUEST_METHOD"] === "POST") {
  require __DIR__ . "/../src/handlers/edit-post-handler.php";
}
