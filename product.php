<?php
require_once 'config.php';
if (!isset($_GET['id']) || !isset($products[$_GET['id']])) {
    header('Location: index.php');
    exit;
}

$productId = (int)$_GET['id'];
$product = $products[$productId];
$pageTitle = $product['name'];
$additionalCSS = '';
$additionalJS = 'product.js';
require_once 'includes/header.php';
?>

<main class="product-page">
    <div class="container">
        <div class="product-detail">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="<?php echo BASE_URL . '/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" id="main-product-image">
                </div>
                <div class="thumbnail-gallery">
                    <!-- For demo, using same image as thumbnail -->
                    <div class="thumbnail active">
                        <img src="<?php echo BASE_URL . '/' . $product['image']; ?>" alt="Thumbnail 1">
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="product-meta">
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">(142 reviews)</span>
                    </div>
                    <div class="sku">SKU: <?php echo htmlspecialchars($product['sku']); ?></div>
                    <div class="availability in-stock">In Stock</div>
                </div>
                <div class="product-price">
                    <span class="current-price">$<?php echo number_format($product['price'], 2); ?></span>
                    <?php if (isset($product['original_price']) && $product['original_price'] > $product['price']): ?>
                    <span class="original-price">$<?php echo number_format($product['original_price'], 2); ?></span>
                    <span class="discount">
                        <?php echo round(($product['original_price'] - $product['price']) / $product['original_price'] * 100); ?>% OFF
                    </span>
                    <?php endif; ?>
                </div>
                <div class="product-description">
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <ul class="features-list">
                        <?php foreach ($product['features'] as $feature): ?>
                        <li><?php echo htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="product-actions">
                    <div class="quantity-selector">
                        <button class="quantity-btn minus">-</button>
                        <input type="number" value="1" min="1" class="quantity-input">
                        <button class="quantity-btn plus">+</button>
                    </div>
                    <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                    <button class="btn btn-outline wishlist-btn">
                        <i class="far fa-heart"></i> Wishlist
                    </button>
                </div>
                <div class="product-meta-footer">
                    <div class="meta-item">
                        <i class="fas fa-truck"></i>
                        <span>Free shipping on orders over $50</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-undo"></i>
                        <span>30-day return policy</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="product-tabs">
            <ul class="tabs-nav">
                <li class="active">Description</li>
                <li>Specifications</li>
                <li>Reviews (142)</li>
            </ul>
            <div class="tabs-content">
                <div class="tab-pane active">
                    <h3>Product Description</h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
                <div class="tab-pane">
                    <h3>Technical Specifications</h3>
                    <table>
                        <tr>
                            <th>Model</th>
                            <td><?php echo htmlspecialchars($product['sku']); ?></td>
                        </tr>
                        <tr>
                            <th>Dimensions</th>
                            <td>6.3 x 3.0 x 0.3 inches</td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>6.7 ounces</td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane">
                    <h3>Customer Reviews</h3>
                    <div class="review">
                        <div class="review-header">
                            <div class="review-author">John D.</div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <p>Excellent product! Works perfectly and exceeded my expectations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <section class="related-products">
            <h2 class="section-title">You May Also Like</h2>
            <div class="products-grid">
                <?php 
                // Display other products as related items
                $relatedProducts = array_diff_key($products, [$productId => '']);
                $relatedProducts = array_slice($relatedProducts, 0, 4);
                foreach ($relatedProducts as $relatedProduct): 
                ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo BASE_URL . '/' . $relatedProduct['image']; ?>" alt="<?php echo htmlspecialchars($relatedProduct['name']); ?>">
                        <div class="product-actions">
                            <button class="btn-wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                            <a href="<?php echo BASE_URL; ?>/product.php?id=<?php echo $relatedProduct['id']; ?>" class="btn-quickview">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?php echo htmlspecialchars($relatedProduct['name']); ?></h3>
                        <div class="product-price">
                            <span class="current-price">$<?php echo number_format($relatedProduct['price'], 2); ?></span>
                            <?php if (isset($relatedProduct['original_price']) && $relatedProduct['original_price'] > $relatedProduct['price']): ?>
                            <span class="original-price">$<?php echo number_format($relatedProduct['original_price'], 2); ?></span>
                            <?php endif; ?>
                        </div>
                        <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $relatedProduct['id']; ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>