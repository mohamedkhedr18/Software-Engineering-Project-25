
<?php
require_once '../config.php';
$adminCSS = 'css/admin-dashboard.css' . basename($_SERVER['PHP_SELF'], '.php') . '.css';
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Admin Dashboard';
require_once '../includes/header.php';
?>

<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>
    
    <div class="admin-nav">
        <a href="users.php" class="btn btn-outline">Manage Users</a>
        <a href="products.php" class="btn btn-outline">Manage Products</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    
    <div class="admin-stats">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p><?php echo count(getUsers()); ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Products</h3>
            <p><?php echo count($products); ?></p>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>