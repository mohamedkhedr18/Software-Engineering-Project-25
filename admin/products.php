<?php
require_once '../config.php';

// Check admin login
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

// Function to save products without duplicating
function saveProducts($products) {
    $configContent = file_get_contents('../config.php');
    
    // Find the products array in the config file
    $startPos = strpos($configContent, '$products = [');
    $endPos = strpos($configContent, '];', $startPos) + 2;
    
    // Replace only the products array portion
    $newProductsContent = '$products = ' . var_export($products, true) . ';';
    $newConfigContent = substr_replace($configContent, $newProductsContent, $startPos, $endPos - $startPos);
    
    file_put_contents('../config.php', $newConfigContent);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        // Add new product
        $newId = !empty($products) ? max(array_keys($products)) + 1 : 1;
        
        $newProduct = [
            'id' => $newId,
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => (float)$_POST['price'],
            'original_price' => isset($_POST['original_price']) && !empty($_POST['original_price']) ? 
                               (float)$_POST['original_price'] : null,
            'image' => 'assets/images/products/default.jpg',
            'sku' => 'PROD-' . uniqid(),
            'features' => array_filter(array_map('trim', explode("\n", $_POST['features'])))
        ];
        
        $products[$newId] = $newProduct;
        saveProducts($products);
        header('Location: products.php');
        exit;
        
    } elseif (isset($_POST['delete_product'])) {
        // Delete product
        $productId = (int)$_POST['product_id'];
        if (isset($products[$productId])) {
            unset($products[$productId]);
            saveProducts($products);
            header('Location: products.php');
            exit;
        }
    }
}

$pageTitle = 'Manage Products';
require_once '../includes/header.php';
?>

<div class="admin-container">
    <h1>Manage Products</h1>
    
    <div class="admin-actions">
        <a href="dashboard.php" class="btn btn-back">← Back to Dashboard</a>
    </div>
    
    <div class="admin-section">
        <h2>Current Products</h2>
        <?php if (empty($products)): ?>
            <p class="no-items">No products found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Original Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $id => $product): ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td>
                                <?php echo isset($product['original_price']) ? 
                                    '$' . number_format($product['original_price'], 2) : 'N/A'; ?>
                            </td>
                            <td class="actions">
                                <a href="../product.php?id=<?php echo $id; ?>" class="btn btn-view" target="_blank">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <form method="post" class="inline-form">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <button type="submit" name="delete_product" class="btn btn-delete" 
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="admin-section">
        <h2>Add New Product</h2>
        <form method="post" class="admin-form">
            <div class="form-group">
                <label for="name">Product Name *</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price *</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="original_price">Original Price (optional)</label>
                    <input type="number" id="original_price" name="original_price" step="0.01" min="0">
                </div>
            </div>
            <div class="form-group">
                <label for="features">Features (one per line)</label>
                <textarea id="features" name="features" rows="4" placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" name="add_product" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>