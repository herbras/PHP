<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
 require_once __DIR__ . '/../../connection/koneksi.php';

$email = $conn->escapeString($_POST['email']);
$password = $conn->escapeString($_POST['password']);

$query = "SELECT id, name, email, password FROM users WHERE email = '$email'";
$result = $conn->query($query);
$user = $result->fetchArray(SQLITE3_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header('Location: /edit-account');
    exit;
} else {
    echo "Login failed. Incorrect email or password.";
}

$conn->close();
?>
