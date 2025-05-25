<?php
require_once 'config.php';

// Redirect to cart if empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$pageTitle = 'Checkout';
$additionalCSS = 'checkout.css';
$additionalJS = 'checkout.js';
require_once 'includes/header.php';

// Calculate totals
$subtotal = 0;
$taxRate = 0.08;
$shipping = 5.00;
$discount = isset($_SESSION['discount']) ? $_SESSION['discount'] : 0;

foreach ($_SESSION['cart'] as $productId => $item) {
    if (isset($products[$productId])) {
        $subtotal += $products[$productId]['price'] * $item['quantity'];
    }
}

$tax = $subtotal * $taxRate;
$total = $subtotal + $tax + $shipping - $discount;
?>

<main class="checkout-page">
    <div class="container">
        <div class="checkout-header">
            <h1>Checkout</h1>
            <div class="checkout-steps">
                <div class="step completed">
                    <span class="step-number">1</span>
                    <span class="step-text">Cart</span>
                </div>
                <div class="step active">
                    <span class="step-number">2</span>
                    <span class="step-text">Information</span>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span class="step-text">Shipping</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span class="step-text">Payment</span>
                </div>
            </div>
        </div>

        <div class="checkout-container">
            <form id="checkout-form" method="post" action="checkout-process.php" class="checkout-form">
                <div class="checkout-section">
                    <h2>Contact Information</h2>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required 
                               value="<?php echo isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : ''; ?>">
                    </div>
                </div>

                <div class="checkout-section">
                    <h2>Shipping Address</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="apartment">Apartment, suite, etc. (optional)</label>
                        <input type="text" id="apartment" name="apartment">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select id="country" name="country" required>
                                <option value="">Select Country</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="UK">United Kingdom</option>
                                <!-- Add more countries as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="state">State/Province</label>
                            <input type="text" id="state" name="state" required>
                        </div>
                        <div class="form-group">
                            <label for="zip">ZIP/Postal Code</label>
                            <input type="text" id="zip" name="zip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" required
                               value="<?php echo isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : ''; ?>">
                    </div>
                </div>

                <div class="checkout-section">
                    <h2>Shipping Method</h2>
                    <div class="shipping-methods">
                        <div class="shipping-method">
                            <input type="radio" id="standard-shipping" name="shipping_method" value="standard" checked>
                            <label for="standard-shipping">
                                <span class="method-name">Standard Shipping</span>
                                <span class="method-price">$5.00</span>
                                <span class="method-duration">3-5 business days</span>
                            </label>
                        </div>
                        <div class="shipping-method">
                            <input type="radio" id="express-shipping" name="shipping_method" value="express">
                            <label for="express-shipping">
                                <span class="method-name">Express Shipping</span>
                                <span class="method-price">$12.00</span>
                                <span class="method-duration">1-2 business days</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="checkout-section">
                    <h2>Payment Method</h2>
                    <div class="payment-methods">
                        <div class="payment-method">
                            <input type="radio" id="credit-card" name="payment_method" value="credit_card" checked>
                            <label for="credit-card">
                                <i class="far fa-credit-card"></i>
                                <span>Credit Card</span>
                            </label>
                            <div class="payment-details" id="credit-card-details">
                                <div class="form-group">
                                    <label for="card-number">Card Number</label>
                                    <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="card-expiry">Expiration Date</label>
                                        <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/YY">
                                    </div>
                                    <div class="form-group">
                                        <label for="card-cvc">CVC</label>
                                        <input type="text" id="card-cvc" name="card_cvc" placeholder="123">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="card-name">Name on Card</label>
                                    <input type="text" id="card-name" name="card_name">
                                </div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="paypal" name="payment_method" value="paypal">
                            <label for="paypal">
                                <i class="fab fa-paypal"></i>
                                <span>PayPal</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="checkout-actions">
                    <a href="cart.php" class="btn btn-outline">Back to Cart</a>
                    <button type="submit" class="btn btn-primary">Complete Order</button>
                </div>
            </form>

            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="order-items">
                    <?php foreach ($_SESSION['cart'] as $productId => $item): 
                        if (!isset($products[$productId])) continue;
                        $product = $products[$productId];
                    ?>
                    <div class="order-item">
                        <div class="item-image">
                            <img src="<?php echo BASE_URL . '/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="item-quantity">Qty: <?php echo $item['quantity']; ?></div>
                            <div class="item-price">$<?php echo number_format($product['price'] * $item['quantity'], 2); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="order-totals">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="total-row">
                        <span>Shipping</span>
                        <span>$<?php echo number_format($shipping, 2); ?></span>
                    </div>
                    <div class="total-row">
                        <span>Tax</span>
                        <span>$<?php echo number_format($tax, 2); ?></span>
                    </div>
                    <?php if ($discount > 0): ?>
                    <div class="total-row discount">
                        <span>Discount</span>
                        <span>-$<?php echo number_format($discount, 2); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="total-row grand-total">
                        <span>Total</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>