<?php
require_once 'config.php';
$pageTitle = 'Home';
$additionalCSS = 'animations.css';
require_once 'includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <h1>TechBazaar</h1>
        <p>buy smart things, with best prices</p>
        <a href="#featured" class="btn btn-primary pulse">Shop Now</a>
    </div>
</section>

<section class="featured-categories">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="categories-grid">
            <div class="category-card">
                <img src="<?php echo BASE_URL; ?>/assets/images/categories/phone.jpg" alt="Smartphones">
                <div class="category-info">
                    <h3>Smartphones</h3>
                    <a href="#" class="btn btn-outline">Explore</a>
                </div>
            </div>
            <div class="category-card">
                <img src="<?php echo BASE_URL; ?>/assets/images/categories/alienware-gaming-laptop.webp" alt="Laptops">
                <div class="category-info">
                    <h3>Laptops</h3>
                    <a href="#" class="btn btn-outline">Explore</a>
                </div>
            </div>
            <div class="category-card">
                <img src="<?php echo BASE_URL; ?>/assets/images/categories/purple-light-retro-headphones.webp" alt="Audio">
                <div class="category-info">
                    <h3>Headphones</h3>
                    <a href="#" class="btn btn-outline">Explore</a>
                </div>
            </div>
            <div class="category-card">
                <img src="<?php echo BASE_URL; ?>/assets/images/categories/consolesjpg.jpg" alt="Smart Home">
                <div class="category-info">
                    <h3>consoles</h3>
                    <a href="#" class="btn btn-outline">Explore</a>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo BASE_URL . '/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-actions">
                        <button class="btn-wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                        <a href="<?php echo BASE_URL; ?>/product.php?id=<?php echo $product['id']; ?>" class="btn-quickview">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                <div class="product-info">
                    <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <div class="product-price">
                        <span class="current-price">$<?php echo number_format($product['price'], 2); ?></span>
                        <?php if (isset($product['original_price']) && $product['original_price'] > $product['price']): ?>
                        <span class="original-price">$<?php echo number_format($product['original_price'], 2); ?></span>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                        Add to Cart
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo BASE_URL . '/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-actions">
                        <button class="btn-wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                        <a href="<?php echo BASE_URL; ?>/product.php?id=<?php echo $product['id']; ?>" class="btn-quickview">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                <div class="product-info">
                    <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <div class="product-price">
                        <span class="current-price">$<?php echo number_format($product['price'], 2); ?></span>
                        <?php if (isset($product['original_price']) && $product['original_price'] > $product['price']): ?>
                        <span class="original-price">$<?php echo number_format($product['original_price'], 2); ?></span>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                        Add to Cart
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php 
require_once 'includes/footer.php';
?>