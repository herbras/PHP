<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../connection/koneksi.php';

function generateUpdatedTableHTML($conn) {
    $html = '';
    $query = "SELECT * FROM users";
    $result = $conn->query($query);

    if ($result) {
        $html .= '<table class="table table-bordered">';
        $html .= '<thead><tr><th>Name</th><th>Email</th><th>Actions</th></tr></thead>';
        $html .= '<tbody>';

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $html .= '<td>';

      // Tombol Edit
      $userJson = htmlspecialchars(json_encode($row));
      $html .= '<a href="#" class="btn btn-sm btn-primary" onclick="editUser(' . $userJson . ')">Edit</a> ';

      // Tombol Delete
      $userId = htmlspecialchars($row['id']);
      $html .= '<form method="post" action="/delete-data" hx-post="/delete-data" hx-target="#tableContainer" hx-vals=\'{"user_id": "' . $userId . '"}\'>';
      $html .= '<input type="hidden" name="user_id" value="' . $userId . '">';
      $html .= '<button type="submit" class="btn btn-sm btn-danger">Delete</button>';
      $html .= '</form>';

            $html .= '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
    } else {
        $html .= 'Error in query execution: ' . $conn->lastErrorMsg();
    }

    return $html;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->escapeString($_POST['name']);
    $email = $conn->escapeString($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $insert_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->exec($insert_query)) {
        // Mengupdate tabel
        $updatedTableHTML = generateUpdatedTableHTML($conn);
    
        // Membuat pesan sukses
        $responseMessage = "<div id='response' class='alert alert-success'>New user added successfully.</div>";
    
        // Menggabungkan kedua HTML
        echo $responseMessage . $updatedTableHTML;
    } else {
        $errorMsg = htmlspecialchars($conn->lastErrorMsg());
        echo "<div id='response' class='alert alert-danger'>ERROR: Could not execute query: $errorMsg</div>";
    }
    
}

$conn->close();
?>
