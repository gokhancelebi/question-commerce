@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-6xl px-4">
        <h1 class="text-3xl font-semibold mb-8">Alışveriş Sepeti</h1>
        
        @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-medium">Sepet Ürünleri ({{ count($cartItems) }})</h2>
                    </div>
                    <div class="divide-y" id="cartItemsList">
                        @foreach($cartItems as $item)
                        <div class="p-4 flex flex-col md:flex-row" data-id="{{ $item['id'] }}">
                            <div class="w-full md:w-24 h-24 flex-shrink-0 bg-gray-100 rounded overflow-hidden mb-4 md:mb-0 md:mr-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover object-center">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-lg mb-1">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $item['specs'] }}</p>
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div class="flex items-center border rounded">
                                        <button class="decrease-quantity px-3 py-1 text-gray-500 hover:text-gray-700" data-id="{{ $item['id'] }}">
                                            <i class="ri-subtract-line"></i>
                                        </button>
                                        <input type="number" min="1" value="{{ $item['quantity'] }}" 
                                            class="quantity-input w-12 px-2 py-1 border-x text-center" 
                                            data-id="{{ $item['id'] }}">
                                        <button class="increase-quantity px-3 py-1 text-gray-500 hover:text-gray-700" data-id="{{ $item['id'] }}">
                                            <i class="ri-add-line"></i>
                                        </button>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="font-medium">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} TL</span>
                                        <button class="remove-item text-gray-400 hover:text-red-500" data-id="{{ $item['id'] }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="p-4 border-t bg-gray-50 flex flex-wrap gap-4 justify-between">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-gray-700 hover:text-primary">
                            <i class="ri-arrow-left-line mr-2"></i>
                            Alışverişe Devam Et
                        </a>
                        <button id="clearCartBtn" class="inline-flex items-center text-red-500 hover:text-red-700">
                            <i class="ri-delete-bin-line mr-2"></i>
                            Sepeti Temizle
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden sticky top-24">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-medium">Sipariş Özeti</h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ara Toplam:</span>
                            <span id="subtotal" class="font-medium">{{ number_format($subtotal, 2, ',', '.') }} TL</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kargo:</span>
                            <span id="shipping" class="font-medium">{{ number_format($shipping, 2, ',', '.') }} TL</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between text-lg font-bold">
                            <span>Toplam:</span>
                            <span id="total" class="text-primary">{{ number_format($total, 2, ',', '.') }} TL</span>
                        </div>
                        <button id="checkoutBtn" class="w-full bg-primary text-white py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center justify-center">
                            <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                <i class="ri-secure-payment-line"></i>
                            </div>
                            Ödemeye Geç
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <div class="w-20 h-20 flex items-center justify-center text-gray-300 mx-auto mb-4">
                <i class="ri-shopping-cart-line ri-4x"></i>
            </div>
            <h2 class="text-xl font-medium mb-2">Sepetiniz boş</h2>
            <p class="text-gray-500 mb-6">Ürünleri keşfedin ve sepetinize ekleyin</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white !rounded-button hover:bg-opacity-90 transition-all">
                <i class="ri-shopping-bag-line mr-2"></i>
                Alışverişe Başla
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle quantity changes
        const quantityInputs = document.querySelectorAll('.quantity-input');
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.getAttribute('data-id');
                const quantity = parseInt(this.value);
                
                if (quantity > 0) {
                    updateCartItem(productId, quantity);
                }
            });
        });
        
        // Handle increase quantity button
        const increaseButtons = document.querySelectorAll('.increase-quantity');
        increaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const input = document.querySelector(`.quantity-input[data-id="${productId}"]`);
                let quantity = parseInt(input.value) + 1;
                input.value = quantity;
                updateCartItem(productId, quantity);
            });
        });
        
        // Handle decrease quantity button
        const decreaseButtons = document.querySelectorAll('.decrease-quantity');
        decreaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const input = document.querySelector(`.quantity-input[data-id="${productId}"]`);
                let quantity = parseInt(input.value) - 1;
                if (quantity > 0) {
                    input.value = quantity;
                    updateCartItem(productId, quantity);
                }
            });
        });
        
        // Handle remove item
        const removeButtons = document.querySelectorAll('.remove-item');
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                removeCartItem(productId);
            });
        });
        
        // Handle clear cart
        const clearCartBtn = document.getElementById('clearCartBtn');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', function() {
                if (confirm('Sepetinizdeki tüm ürünleri silmek istediğinize emin misiniz?')) {
                    clearCart();
                }
            });
        }
        
        // Handle checkout button
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function() {
                // For now, just show a message
                showNotification('Ödeme sayfasına yönlendiriliyorsunuz', 'success', true);
                
                // In a real implementation, you would redirect to a checkout page
                setTimeout(() => {
                    window.location.href = '/checkout';
                }, 1500);
            });
        }
        
        // Function to update cart item
        function updateCartItem(productId, quantity) {
            fetch('{{ route('cart.update') }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    document.getElementById('cartCount').textContent = data.cartCount;
                    
                    // Update totals
                    document.getElementById('subtotal').textContent = formatPrice(data.subtotal);
                    document.getElementById('shipping').textContent = formatPrice(data.shipping);
                    document.getElementById('total').textContent = formatPrice(data.total);
                    
                    showNotification('Sepet güncellendi', 'success');
                    
                    // If quantity is 0, remove the item from DOM
                    if (quantity === 0) {
                        const itemElement = document.querySelector(`[data-id="${productId}"]`);
                        if (itemElement) {
                            itemElement.remove();
                        }
                        
                        // Check if cart is empty
                        if (data.cartCount === 0) {
                            window.location.reload();
                        }
                    }
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Bir hata oluştu', 'error');
            });
        }
        
        // Function to remove cart item
        function removeCartItem(productId) {
            fetch('{{ route('cart.remove') }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    document.getElementById('cartCount').textContent = data.cartCount;
                    
                    // Update totals
                    document.getElementById('subtotal').textContent = formatPrice(data.subtotal);
                    document.getElementById('shipping').textContent = formatPrice(data.shipping);
                    document.getElementById('total').textContent = formatPrice(data.total);
                    
                    // Remove item from DOM
                    const itemElement = document.querySelector(`[data-id="${productId}"]`);
                    if (itemElement) {
                        itemElement.remove();
                    }
                    
                    showNotification('Ürün sepetten kaldırıldı', 'info');
                    
                    // Check if cart is empty
                    if (data.cartCount === 0) {
                        window.location.reload();
                    }
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Bir hata oluştu', 'error');
            });
        }
        
        // Function to clear cart
        function clearCart() {
            fetch('{{ route('cart.clear') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Sepet temizlendi', 'info');
                    // Reload the page to show empty cart
                    window.location.reload();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Bir hata oluştu', 'error');
            });
        }
        
        // Function to format price
        function formatPrice(price) {
            return new Intl.NumberFormat('tr-TR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(price) + ' TL';
        }
        
        // Function to show notification
        function showNotification(message, type = 'success', isCheckout = false) {
            const iconClass = type === 'success' ? 'ri-check-line' : type === 'info' ? 'ri-information-line' : 'ri-error-warning-line';
            const iconColor = type === 'success' ? 'text-green-500' : type === 'info' ? 'text-primary' : 'text-red-500';
            const notification = document.createElement('div');
            notification.className = 'fixed top-20 right-4 bg-white p-4 rounded-lg shadow-lg z-50 animate-fade-in';
            if (isCheckout) {
                notification.innerHTML = `
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center ${iconColor} mr-3">
                        <i class="ri-secure-payment-line ri-lg"></i>
                    </div>
                    <div>
                        <p class="font-medium">${message}</p>
                        <p class="text-sm text-gray-600">Lütfen bekleyin...</p>
                    </div>
                </div>
                `;
            } else {
                notification.innerHTML = `
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center ${iconColor} mr-3">
                        <i class="${iconClass} ri-lg"></i>
                    </div>
                    <div>
                        <p class="font-medium">${message}</p>
                    </div>
                </div>
                `;
            }
            document.body.appendChild(notification);
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.classList.add('animate-fade-out');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    });
</script>
@endpush 