<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../connection/koneksi.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $name = $conn->escapeString($_POST['name']);
    $email = $conn->escapeString($_POST['email']);
    $password = $conn->escapeString($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->exec($query)) {
        $_SESSION['user_id'] = $conn->lastInsertRowID();
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

        header('Location: /edit-account');
        exit();
    } else {
        echo "ERROR: Could not execute query: " . $conn->lastErrorMsg();
    }
} else {
    die("Form values are not set.");
}

$conn->close();
?>
