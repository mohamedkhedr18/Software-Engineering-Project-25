<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - TechBazaar' : 'TechBazaar - Premium Electronics Store'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
    <?php if (isset($additionalCSS)): ?>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/<?php echo $additionalCSS; ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="D:\programs\XAMPP\htdocs\techbazaar\assets\images\logo.png">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <a href="<?php echo BASE_URL; ?>/index.php" class="logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="TechBazaar">

                <span>TechBazaar</span>
            </a>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
                    <li><a href="#" <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'class="active"' : ''; ?>>Shop</a></li>
                    <li><a href="#" <?php echo basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'class="active"' : ''; ?>>Categories</a></li>
                    <li><a href="#" <?php echo basename($_SERVER['PHP_SELF']) == 'deals.php' ? 'class="active"' : ''; ?>>Deals</a></li>
                    <li><a href="#" <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'class="active"' : ''; ?>>About</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <div class="search-box">
                    <input type="text" placeholder="Search products...">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
                <a href="<?php echo isLoggedIn() ? BASE_URL.'/dashboard.php' : BASE_URL.'/login.php'; ?>" class="user-btn <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i>
                </a>
                <a href="<?php echo BASE_URL; ?>/cart.php" class="cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">
                        <?php 
                        $count = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $count += $item['quantity'];
                        }
                        echo $count;
                        ?>
                    </span>
                </a>
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>