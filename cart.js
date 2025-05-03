document.addEventListener('DOMContentLoaded', function() {
    // Quantity controls
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value);
            
            if (this.classList.contains('minus') {
                value = value > 1 ? value - 1 : 1;
            } else {
                value = value + 1;
            }
            
            input.value = value;
            updateItemTotal(this.closest('.cart-item'));
        });
    });

    // Quantity input validation
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            }
            updateItemTotal(this.closest('.cart-item'));
        });
    });

    // Remove item
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.cart-item, .saved-item');
            item.classList.add('removing');
            
            setTimeout(() => {
                item.remove();
                updateCartTotals();
            }, 300);
        });
    });

    // Save for later / Move to cart
    document.querySelectorAll('.save-later, .move-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.cart-item, .saved-item');
            item.classList.add('removing');
            
            setTimeout(() => {
                item.remove();
                updateCartTotals();
                // In a real app, you would move the item between sections
            }, 300);
        });
    });

    // Update item total price
    function updateItemTotal(item) {
        const price = parseFloat(item.querySelector('.current-price').textContent.replace('$', ''));
        const quantity = parseInt(item.querySelector('.quantity-input').value);
        const total = (price * quantity).toFixed(2);
        item.querySelector('.item-total').textContent = `$${total}`;
        updateCartTotals();
    }

    // Update cart summary totals
    function updateCartTotals() {
        let subtotal = 0;
        let itemCount = 0;
        
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.querySelector('.current-price').textContent.replace('$', ''));
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            subtotal += price * quantity;
            itemCount += quantity;
        });
        
        // Update subtotal display
        const subtotalElement = document.querySelector('.summary-row:first-child span:last-child');
        if (subtotalElement) {
            subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
        }
        
        // Update item count in subtotal text
        const subtotalText = document.querySelector('.summary-row:first-child span:first-child');
        if (subtotalText) {
            subtotalText.textContent = `Subtotal (${itemCount} ${itemCount === 1 ? 'item' : 'items'})`;
        }
        
        // Calculate tax (example: 8%)
        const tax = subtotal * 0.08;
        document.querySelector('.summary-row:nth-child(3) span:last-child').textContent = `$${tax.toFixed(2)}`;
        
        // Calculate total
        const discount = 50.00; // Example fixed discount
        const total = subtotal + tax - discount;
        document.querySelector('.summary-total span:last-child').textContent = `$${total.toFixed(2)}`;
        
        // Update cart count in header
        document.querySelector('.cart-count').textContent = itemCount;
    }

    // Initialize cart totals
    updateCartTotals();
});