// DOM Elements
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const mainNav = document.querySelector('.main-nav');
const header = document.querySelector('.main-header');
const cartCount = document.querySelector('.cart-count');
const productsGrid = document.querySelector('.products-grid');

// Sample product data
const products = [
    {
        id: 1,
        name: 'Premium Wireless Headphones',
        price: 199.99,
        originalPrice: 249.99,
        image: 'assets/images/products/1.jpg',
        category: 'Electronics',
        rating: 4.5,
        reviews: 142,
        badge: 'BESTSELLER'
    },
    // More products...
];

// Initialize cart
let cart = JSON.parse(localStorage.getItem('cart')) || [];
updateCartCount();

// Mobile menu toggle
mobileMenuBtn.addEventListener('click', () => {
    mainNav.classList.toggle('active');
    mobileMenuBtn.innerHTML = mainNav.classList.contains('active') ? 
        '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
});

// Header scroll effect
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Render products
function renderProducts(productsToRender) {
    productsGrid.innerHTML = productsToRender.map(product => `
        <div class="product-card" data-id="${product.id}">
            ${product.badge ? `<span class="product-badge">${product.badge}</span>` : ''}
            <img src="${product.image}" alt="${product.name}" class="product-image">
            <div class="product-info">
                <h3 class="product-title">${product.name}</h3>
                <div class="product-price">
                    <span class="current-price">$${product.price.toFixed(2)}</span>
                    ${product.originalPrice ? `
                        <span class="original-price">$${product.originalPrice.toFixed(2)}</span>
                        <span class="discount">${Math.round((1 - product.price / product.originalPrice) * 100)}% OFF</span>
                    ` : ''}
                </div>
                <div class="product-actions">
                    <button class="btn btn-primary add-to-cart">Add to Cart</button>
                    <button class="btn btn-outline wishlist-btn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    // Add event listeners to all add-to-cart buttons
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', addToCart);
    });
}

// Add to cart function
function addToCart(e) {
    const productId = parseInt(e.target.closest('.product-card').dataset.id);
    const product = products.find(p => p.id === productId);
    
    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            ...product,
            quantity: 1
        });
    }
    
    // Save to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    
    // Show added to cart animation
    const btn = e.target;
    btn.innerHTML = '<i class="fas fa-check"></i> Added';
    btn.style.backgroundColor = 'var(--success)';
    
    setTimeout(() => {
        btn.innerHTML = 'Add to Cart';
        btn.style.backgroundColor = 'var(--primary)';
    }, 1500);
}

// Update cart count
function updateCartCount() {
    const count = cart.reduce((total, item) => total + item.quantity, 0);
    cartCount.textContent = count;
    cartCount.style.display = count > 0 ? 'flex' : 'none';
}

// Initial render
renderProducts(products);

// Newsletter form submission
const newsletterForm = document.querySelector('.newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = newsletterForm.querySelector('input').value;
        
        // Simulate API call
        setTimeout(() => {
            newsletterForm.innerHTML = `
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <p>Thank you for subscribing!</p>
                </div>
            `;
        }, 1000);
    });
}