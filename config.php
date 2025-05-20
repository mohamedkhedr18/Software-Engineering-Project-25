<?php
// Start session
session_start();

// Define base URL
define('BASE_URL', 'http://localhost/techbazaar');

// Sample product data
$products = [
    1 => [
        'id' => 1,
        'name' => 'Premium Wireless Headphones',
        'description' => 'Experience premium sound quality with our latest wireless headphones. Featuring noise cancellation, 30-hour battery life, and comfortable over-ear design.',
        'price' => 199.99,
        'original_price' => 249.99,
        'image' => 'assets/images/products/headphones.jpg',
        'sku' => 'HD-2023-BLK',
        'features' => [
            'Active Noise Cancellation',
            '30-hour playtime',
            'Bluetooth 5.0',
            'Built-in microphone'
        ]
    ],
    2 => [
        'id' => 2,
        'name' => 'Smartphone Pro Max 2023',
        'description' => 'The latest flagship smartphone with advanced camera system and powerful processor.',
        'price' => 999.99,
        'original_price' => 1099.99,
        'image' => 'assets/images/products/smartphone.jpg',
        'sku' => 'SP-2023-PRO',
        'features' => [
            '6.7" OLED Display',
            'Triple camera system',
            '5G connectivity',
            'All-day battery life'
        ]
    ],
    // Add more products as needed
];

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Simple authentication simulation
function isLoggedIn() {
    return isset($_SESSION['user']);
}

function loginUser($email) {
    // In a real app, you'd verify credentials
    $_SESSION['user'] = [
        'name' => 'خضر كرويته',
        'email' => $email,
        'phone' => '0105558291'
    ];
}

function logoutUser() {
    unset($_SESSION['user']);
}
?>