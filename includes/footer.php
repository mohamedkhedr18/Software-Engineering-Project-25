    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>TechBazaar</h3>
                    <p>Your premier destination for cutting-edge electronics and tech gadgets.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Shop</h4>
                    <ul>
                        <li><a href="#">All Products</a></li>
                        <li><a href="#">Featured</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Deals & Promotions</a></li>
                        <li><a href="#">Gift Cards</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Shipping Policy</a></li>
                        <li><a href="#">Returns & Exchanges</a></li>
                        <li><a href="#">Warranty</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> TechBazaar. All rights reserved.</p>
                <div class="payment-methods">
                    <img src="<?php echo BASE_URL; ?>/assets/images/payment-methods.png" alt="Payment Methods">
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php echo BASE_URL; ?>/js/main.js"></script>
    <?php if (isset($additionalJS)): ?>
        <script src="<?php echo BASE_URL; ?>/js/<?php echo $additionalJS; ?>"></script>
    <?php endif; ?>
</body>
</html>