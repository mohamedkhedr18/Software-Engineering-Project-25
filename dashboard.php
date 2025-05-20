<?php
require_once 'config.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'My Account';
$additionalCSS = 'dashboard.css';
$additionalJS = 'dashboard.js';
require_once 'includes/header.php';

// Sample orders data
$orders = [
    [
        'id' => 'TB-2023-4567',
        'date' => 'Oct 15, 2023',
        'status' => 'delivered',
        'total' => 199.99
    ],
    [
        'id' => 'TB-2023-4566',
        'date' => 'Oct 10, 2023',
        'status' => 'shipped',
        'total' => 499.98
    ],
    [
        'id' => 'TB-2023-4565',
        'date' => 'Oct 5, 2023',
        'status' => 'processing',
        'total' => 129.99
    ]
];
?>

<main class="dashboard-page">
    <div class="dashboard-container">
        <aside class="dashboard-sidebar">
            <div class="user-profile">
                <div class="avatar">
                    <img src="<?php echo BASE_URL; ?>/assets/images/avatar.jpg" alt="User Avatar">
                </div>
                <div class="user-info">
                    <h3><?php echo htmlspecialchars($_SESSION['user']['name']); ?></h3>
                    <p class="email"><?php echo htmlspecialchars($_SESSION['user']['email']); ?></p>
                    <a href="edit-profile.php" class="btn btn-outline edit-profile">Edit Profile</a>
                </div>
            </div>
            
            <nav class="dashboard-nav">
                <ul>
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="orders.php">
                            <i class="fas fa-box"></i> My Orders
                            <span class="badge"><?php echo count($orders); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="wishlist.php">
                            <i class="fas fa-heart"></i> Wishlist
                            <span class="badge">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="addresses.php">
                            <i class="fas fa-map-marker-alt"></i> Addresses
                        </a>
                    </li>
                    <li>
                        <a href="payment-methods.php">
                            <i class="fas fa-credit-card"></i> Payment Methods
                        </a>
                    </li>
                    <li>
                        <a href="account-settings.php">
                            <i class="fas fa-cog"></i> Account Settings
                        </a>
                    </li>
                    <li>
                        <a href="?logout=1">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <div class="dashboard-content">
            <div class="dashboard-header">
                <h1>Dashboard</h1>
                <div class="welcome-message">
                    Welcome back, <strong><?php echo htmlspecialchars(explode(' ', $_SESSION['user']['name'])[0]); ?></strong>! Here's what's happening with your account.
                </div>
            </div>
            
            <div class="dashboard-cards">
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="card-content">
                        <h3>Recent Orders</h3>
                        <p>You have <strong><?php echo count($orders); ?></strong> recent orders</p>
                        <a href="orders.php" class="btn btn-text">View Orders <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-content">
                        <h3>Wishlist</h3>
                        <p>You have <strong>5</strong> saved items</p>
                        <a href="wishlist.php" class="btn btn-text">View Wishlist <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="card-content">
                        <h3>Special Offers</h3>
                        <p>You have <strong>2</strong> exclusive offers</p>
                        <a href="deals.php" class="btn btn-text">View Offers <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="recent-orders">
                <div class="section-header">
                    <h2>Recent Orders</h2>
                    <a href="orders.php" class="btn btn-text">View All</a>
                </div>
                
                <div class="orders-table">
                    <div class="table-header">
                        <div class="col order-id">Order ID</div>
                        <div class="col date">Date</div>
                        <div class="col status">Status</div>
                        <div class="col total">Total</div>
                        <div class="col actions">Actions</div>
                    </div>
                    
                    <?php foreach ($orders as $order): ?>
                    <div class="table-row">
                        <div class="col order-id">#<?php echo htmlspecialchars($order['id']); ?></div>
                        <div class="col date"><?php echo htmlspecialchars($order['date']); ?></div>
                        <div class="col status">
                            <span class="badge <?php echo htmlspecialchars($order['status']); ?>">
                                <?php echo ucfirst(htmlspecialchars($order['status'])); ?>
                            </span>
                        </div>
                        <div class="col total">$<?php echo number_format($order['total'], 2); ?></div>
                        <div class="col actions">
                            <a href="order-details.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-text">View</a>
                            <?php if ($order['status'] === 'delivered'): ?>
                            <button class="btn btn-text">Reorder</button>
                            <?php elseif ($order['status'] === 'shipped'): ?>
                            <button class="btn btn-text">Track</button>
                            <?php elseif ($order['status'] === 'processing'): ?>
                            <button class="btn btn-text">Cancel</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="account-overview">
                <div class="section-header">
                    <h2>Account Overview</h2>
                </div>
                
                <div class="overview-grid">
                    <div class="overview-card">
                        <h3>Personal Information</h3>
                        <div class="info-row">
                            <span class="label">Name:</span>
                            <span class="value"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Email:</span>
                            <span class="value"><?php echo htmlspecialchars($_SESSION['user']['email']); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Phone:</span>
                            <span class="value"><?php echo htmlspecialchars($_SESSION['user']['phone']); ?></span>
                        </div>
                        <a href="edit-profile.php" class="btn btn-outline">Edit Profile</a>
                    </div>
                    
                    <div class="overview-card">
                        <h3>Default Shipping Address</h3>
                        <div class="address-details">
                            <p>بولاق الدكرور<br>
                            عماره132<br>
                            محافظة الجيزة<br>
                            مصر</p>
                        </div>
                        <a href="addresses.php" class="btn btn-outline">Manage Addresses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>