<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../connection/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    // Pengguna belum login, redirect ke halaman login
    header('Location: /login');
    exit();
}
// Fetch all users from the database
$query = "SELECT * FROM users";
$result = $conn->query($query);

// Check for query error or empty result
if (!$result) {
    die

        ("Error in query execution: " . $conn->lastErrorMsg());
}

$users = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $users[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
:root {
    --bs-pink: #ff69b4;
    --bs-dark-pink: #ff85c2;
}

body {
    background-color: #fff3f8;
    color: #333;
}

.btn-primary, .btn-success {
    background-color: var(--bs-pink);
    border-color: var(--bs-pink);
}

.btn-primary:hover, .btn-success:hover {
    background-color: var(--bs-dark-pink);
    border-color: var(--bs-dark-pink);
}

.table thead th {
    background-color: var(--bs-pink);
    color: #fff;
}

.form-label {
    color: var(--bs-pink);
}

.modal-content {
    border-color: var(--bs-pink);
}

.modal-header {
    background-color: var(--bs-pink);
    color: #fff;
}

.btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}

    </style>
        <script src="https://unpkg.com/htmx.org"></script>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="container mt-4">

<p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
<a href="/logout" class="btn btn-danger">Logout</a>
    <h2>Edit Account</h2>
    <div id="tableContainer">
    <div id="response"></div>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="#" class="btn btn-sm btn-primary" onclick="editUser(<?php echo htmlspecialchars(json_encode($user)); ?>)">Edit</a>

                    
                
                            <form method="post" action="/delete-data" hx-post="/delete-data" hx-target="#tableContainer" hx-vals='{"user_id": "<?php echo $user['id']; ?>"}'>
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>



                        </td>
                    </tr>
        <?php endforeach; ?>
    </tbody>
</table></div>


<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editUserForm" method="post" action="/update-data" hx-post="/update-data" hx-target="#tableContainer" >
                    <input type="hidden" name="user_id" id="modalUserId">
                    <div class="mb-3">
                        <label for="modalName" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" id="modalName">
                    </div>
                    <div class="mb-3">
                        <label for="modalEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="modalEmail">
                    </div>
                    <div class="mb-3">
                        <label for="modalPassword" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="modalPassword">
                    </div>
<button type="submit" class="btn btn-primary" name="update">Update</button>
</form>
</div>
</div>
</div>
</div>

</div>
   
</section>
<!-- Edit User Modal -->

<section class="container mt-4">
    <h2>Add New User</h2>
    <form method="post" action="/add-data" hx-post="/add-data" hx-target="#tableContainer" >        <div class="mb-3">
            <label for="addName" class="form-label">Name:</label>
            <input type="text" class="form-control" id="addName" name="name">
        </div>
        <div class="mb-3">
            <label for="addEmail" class="form-label">Email:</label>
            <input type="email" class="form-control" id="addEmail" name="email">
        </div>
        <div class="mb-3">
            <label for="addPassword" class="form-label">Password:</label>
            <input type="password" class="form-control" id="addPassword" name="password">
        </div>
        <button type="submit" class="

btn btn-success">Add User</button>
</form>
</section>
<script>
  function editUser(userData) {
    // Fill the form in the modal
    document.getElementById('modalUserId').value = userData.id;
    document.getElementById('modalName').value = userData.name;
    document.getElementById('modalEmail').value = userData.email;
// Don't set the password field for security reasons
document.getElementById('modalPassword').value = '';
var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
modal.show();

}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
