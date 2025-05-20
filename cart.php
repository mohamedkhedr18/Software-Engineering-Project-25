<?php
require_once 'config.php';
$pageTitle = 'Your Cart';
$additionalCSS = 'cart.css';
$additionalJS = 'cart.js';
require_once 'includes/header.php';

// Handle remove item action
if (isset($_POST['remove_item']) && isset($_POST['product_id'])) {
    $productId = (int)$_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

// Handle update quantity action
if (isset($_POST['update_quantity']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if ($quantity < 1) {
        unset($_SESSION['cart'][$productId]);
    } else {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
}

// Calculate totals
$subtotal = 0;
$taxRate = 0.08; // 8% tax
$discount = 50.00; // Fixed discount for demo

foreach ($_SESSION['cart'] as $productId => $item) {
    if (isset($products[$productId])) {
        $subtotal += $products[$productId]['price'] * $item['quantity'];
    }
}

$tax = $subtotal * $taxRate;
$total = $subtotal + $tax - $discount;
?>

<main class="cart-page">
    <div class="container">
        <div class="cart-header">
            <h1>Your Shopping Cart</h1>
            <div class="cart-steps">
                <div class="step active">
                    <span class="step-number">1</span>
                    <span class="step-text">Cart</span>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span class="step-text">Shipping</span>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span class="step-text">Payment</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span class="step-text">Review</span>
                </div>
            </div>
        </div>

        <div class="cart-container">
            <div class="cart-items">
                <?php if (empty($_SESSION['cart'])): ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Your cart is empty</h3>
                    <p>Looks like you haven't added any items to your cart yet.</p>
                    <a href="<?php echo BASE_URL; ?>/index.php" class="btn btn-primary">Continue Shopping</a>
                </div>
                <?php else: ?>
                    <?php foreach ($_SESSION['cart'] as $productId => $item): 
                        if (!isset($products[$productId])) continue;
                        $product = $products[$productId];
                    ?>
                    <div class="cart-item" data-product-id="<?php echo $productId; ?>">
                        <div class="item-image">
                            <img src="<?php echo BASE_URL . '/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="item-details">
                            <h3 class="item-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="item-sku">SKU: <?php echo htmlspecialchars($product['sku']); ?></div>
                            <div class="item-availability">In Stock</div>
                            <div class="item-actions">
                                <button class="btn btn-outline save-later">
                                    <i class="far fa-bookmark"></i> Save for later
                                </button>
                                <form method="post" class="remove-item-form">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <input type="hidden" name="remove_item" value="1">
                                    <button type="submit" class="btn btn-text remove-item">
                                        <i class="far fa-trash-alt"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="item-price">
                            <div class="current-price">$<?php echo number_format($product['price'], 2); ?></div>
                            <?php if (isset($product['original_price']) && $product['original_price'] > $product['price']): ?>
                            <div class="original-price">$<?php echo number_format($product['original_price'], 2); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="item-quantity">
                            <form method="post" class="quantity-form">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <input type="hidden" name="update_quantity" value="1">
                                <button type="button" class="quantity-btn minus">-</button>
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                                <button type="button" class="quantity-btn plus">+</button>
                            </form>
                        </div>
                        <div class="item-total">
                            $<?php echo number_format($product['price'] * $item['quantity'], 2); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($_SESSION['cart'])): ?>
            <div class="cart-summary">
                <div class="summary-card">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal (<?php echo count($_SESSION['cart']); ?> items)</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax</span>
                        <span>$<?php echo number_format($tax, 2); ?></span>
                    </div>
                    <div class="summary-row discount">
                        <span>Discount</span>
                        <span>-$<?php echo number_format($discount, 2); ?></span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="coupon-form">
                        <input type="text" placeholder="Enter coupon code">
                        <button class="btn btn-outline">Apply</button>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/checkout.php" class="btn btn-primary checkout-btn">Proceed to Checkout</a>
                    <div class="payment-methods">
                        <img src="<?php echo BASE_URL; ?>/assets/images/payment-methods.png" alt="Accepted payment methods">
                    </div>
                    <div class="secure-checkout">
                        <i class="fas fa-lock"></i>
                        <span>Secure checkout</span>
                    </div>
                </div>

                <div class="customer-support">
                    <h4>Need Help?</h4>
                    <p>Our customer service team is available 24/7 to assist you with your order.</p>
                    <div class="support-contact">
                        <i class="fas fa-phone"></i>
                        <span>1-800-TECH-BAZ</span>
                    </div>
                    <div class="support-contact">
                        <i class="fas fa-envelope"></i>
                        <span>support@techbazaar.com</span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>