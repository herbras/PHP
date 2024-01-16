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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $conn->escapeString($_POST['user_id']);

    $delete_query = "DELETE FROM users WHERE id = $userId";
    if ($conn->exec($delete_query)) {
        // Mengupdate tabel
        $updatedTableHTML = generateUpdatedTableHTML($conn);
    
        // Membuat pesan sukses
        $responseMessage = "<div id='response' class='alert alert-success'>User deleted successfully.</div>";
    
        // Menggabungkan kedua HTML
        echo $responseMessage . $updatedTableHTML;
    } else {
        echo "<div id='response' class='alert alert-danger'>ERROR: Could not execute query.</div>";
    }
    
    
}

$conn->close();
?>
