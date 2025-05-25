<?php
require_once '../config.php';

// Check admin login
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

// Get all users (we'll store them in a file)
function getUsers() {
    if (file_exists('users.txt')) {
        return unserialize(file_get_contents('users.txt'));
    }
    return [];
}

// Save users to file
function saveUsers($users) {
    file_put_contents('users.txt', serialize($users));
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        // Add new user
        $users = getUsers();
        $newUser = [
            'id' => uniqid(),
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $users[] = $newUser;
        saveUsers($users);
    } elseif (isset($_POST['delete_user'])) {
        // Delete user
        $users = getUsers();
        $users = array_filter($users, function($user) {
            return $user['id'] !== $_POST['user_id'];
        });
        saveUsers($users);
    }
}

$users = getUsers();
$pageTitle = 'Manage Users';
require_once '../includes/header.php';
?>

<div class="admin-users">
    <h1>Manage Users</h1>
    
    <div class="user-list">
        <h2>Current Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo substr($user['id'], 0, 8); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['created_at']; ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="add-user">
        <h2>Add New User</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>