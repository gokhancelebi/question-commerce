// Function to update cart data via AJAX
function updateCartData() {
    fetch('/cart-data')
        .then(response => response.json())
        .then(data => {
            // Update cart count
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = data.count;
            }
            
            // Update cart subtotal if on cart page
            const subtotalElement = document.querySelector('.cart-subtotal');
            if (subtotalElement) {
                subtotalElement.textContent = '$' + data.subtotal.toFixed(2);
            }
            
            // Update shipping cost if on cart page
            const shippingElement = document.querySelector('.cart-shipping');
            if (shippingElement) {
                shippingElement.textContent = '$' + data.shipping.toFixed(2);
            }
            
            // Update total if on cart page
            const totalElement = document.querySelector('.cart-total');
            if (totalElement) {
                totalElement.textContent = '$' + data.total.toFixed(2);
            }
        })
        .catch(error => console.error('Error fetching cart data:', error));
}

// Call updateCartData on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartData();
    
    // Add event delegation for cart updates
    document.body.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.add-to-cart, .remove-from-cart, .clear-cart, .update-cart-qty')) {
            // Wait for the cart operation to complete
            setTimeout(updateCartData, 300);
        }
    });
}); 