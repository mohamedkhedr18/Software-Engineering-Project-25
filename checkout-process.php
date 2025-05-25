<?php
require_once 'config.php';

// Process checkout form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process the order
    $orderData = [
        'customer' => [
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'address' => $_POST['address'],
            'apartment' => $_POST['apartment'] ?? '',
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'state' => $_POST['state'],
            'zip' => $_POST['zip'],
            'phone' => $_POST['phone']
        ],
        'shipping' => [
            'method' => $_POST['shipping_method'],
            'cost' => $_POST['shipping_method'] === 'express' ? 12.00 : 5.00
        ],
        'payment' => [
            'method' => $_POST['payment_method'],
            'details' => $_POST['payment_method'] === 'credit_card' ? [
                'card_number' => substr($_POST['card_number'], -4),
                'card_expiry' => $_POST['card_expiry'],
                'card_name' => $_POST['card_name']
            ] : []
        ],
        'items' => $_SESSION['cart'],
        'totals' => [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $_POST['shipping_method'] === 'express' ? 12.00 : 5.00,
            'discount' => isset($_SESSION['discount']) ? $_SESSION['discount'] : 0,
            'total' => $total
        ],
        'date' => date('Y-m-d H:i:s')
    ];

    // Generate order ID
    $orderId = 'TB-' . strtoupper(uniqid());

    // In a real application, you would save this to a database
    // For this demo, we'll store it in session
    $_SESSION['orders'][$orderId] = $orderData;

    // Clear the cart
    unset($_SESSION['cart']);
    unset($_SESSION['discount']);

    // Redirect to order confirmation
    header("Location: order-confirmation.php?id=$orderId");
    exit;
} else {
    // If someone tries to access this page directly, redirect to checkout
    header('Location: checkout.php');
    exit;
}
?>