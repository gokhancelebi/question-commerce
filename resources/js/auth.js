// Auth AJAX functionality
// This code will be used later to enable AJAX login/register
// Currently it's kept disabled

document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const authModal = document.getElementById('authModal');
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const closeAuthModal = document.getElementById('closeAuthModal');
    const ajaxLoginForm = document.getElementById('ajaxLoginForm');
    const ajaxRegisterForm = document.getElementById('ajaxRegisterForm');
    const loginErrorMessage = document.querySelector('.login-error-message');
    const registerErrorMessage = document.querySelector('.register-error-message');
    
    // Auth modal functionality
    // Initialize modal logic only if authModal exists (for guest users)
    if (authModal) {
        // Show modal when clicking any login/register links
        document.querySelectorAll('a[href*="login"], a[href*="register"], .login-trigger').forEach(function(link) {
            // Skip links that go directly to login or register pages without opening the modal
            if ((link.classList.contains('md:block') || 
                link.textContent.includes('sayfasına git')) && 
                !link.classList.contains('login-trigger')) {
                return;
            }
            
            link.addEventListener('click', function(e) {
                e.preventDefault();
                authModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling
                
                // If link contains "register", switch to register tab
                if (link.getAttribute('href') && link.getAttribute('href').includes('register') && registerTab) {
                    registerTab.click();
                }
            });
        });
        
        if (closeAuthModal) {
            closeAuthModal.addEventListener('click', function() {
                authModal.classList.add('hidden');
                document.body.style.overflow = ''; // Enable scrolling
            });
        }
        
        authModal.addEventListener('click', function(e) {
            if (e.target === authModal) {
                authModal.classList.add('hidden');
                document.body.style.overflow = ''; // Enable scrolling
            }
        });
        
        // Switch tabs
        if (loginTab && registerTab) {
            loginTab.addEventListener('click', function() {
                loginTab.classList.add('border-primary', 'text-primary');
                registerTab.classList.remove('border-primary', 'text-primary');
                loginTab.classList.remove('border-transparent', 'text-gray-500');
                registerTab.classList.add('border-transparent', 'text-gray-500');
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
            });
            
            registerTab.addEventListener('click', function() {
                registerTab.classList.add('border-primary', 'text-primary');
                loginTab.classList.remove('border-primary', 'text-primary');
                registerTab.classList.remove('border-transparent', 'text-gray-500');
                loginTab.classList.add('border-transparent', 'text-gray-500');
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            });
        }
    }
    
    // Helper function to display form errors
    function displayFormErrors(errorElement, errors) {
        if (!errorElement) return;
        
        errorElement.classList.remove('hidden');
        
        if (typeof errors === 'string') {
            errorElement.textContent = errors;
            return;
        }
        
        // Clear previous errors
        errorElement.innerHTML = '';
        
        // Create error list
        const errorList = document.createElement('ul');
        errorList.className = 'list-disc pl-5';
        
        // Add each error to the list
        Object.values(errors).forEach(errorArray => {
            errorArray.forEach(error => {
                const listItem = document.createElement('li');
                listItem.textContent = error;
                errorList.appendChild(listItem);
            });
        });
        
        errorElement.appendChild(errorList);
    }

    // Show notification function
    function showNotification(message, type = 'success') {
        const iconClass = type === 'success' ? 'ri-check-line' : type === 'info' ? 'ri-information-line' : 'ri-error-warning-line';
        const iconColor = type === 'success' ? 'text-green-500' : type === 'info' ? 'text-primary' : 'text-red-500';
        const notification = document.createElement('div');
        notification.className = 'fixed top-20 right-4 bg-white p-4 rounded-lg shadow-lg z-50 animate-fade-in';
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
        document.body.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.classList.add('animate-fade-out');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
    
    /*
    // The following code is temporarily commented out
    // It will be used later to enable AJAX login/register functionality
    
    // AJAX Login Form Submission
    if (ajaxLoginForm) {
        ajaxLoginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous error messages
            loginErrorMessage.classList.add('hidden');
            
            // Get form data
            const formData = new FormData(ajaxLoginForm);
            
            // Show loading state on button
            const submitBtn = ajaxLoginForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mx-auto"></div>';
            submitBtn.disabled = true;
            
            // Submit form via AJAX
            fetch('/ajax/login', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showNotification(data.message, 'success');
                    
                    // Close modal
                    authModal.classList.add('hidden');
                    document.body.style.overflow = '';
                    
                    // Redirect after a short delay
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    // Show error message
                    displayFormErrors(loginErrorMessage, data.message);
                    
                    // Reset button
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                // Show error message
                displayFormErrors(loginErrorMessage, 'Bir hata oluştu. Lütfen tekrar deneyin.');
                
                // Reset button
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // AJAX Register Form Submission
    if (ajaxRegisterForm) {
        ajaxRegisterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous error messages
            registerErrorMessage.classList.add('hidden');
            
            // Get form data
            const formData = new FormData(ajaxRegisterForm);
            
            // Show loading state on button
            const submitBtn = ajaxRegisterForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mx-auto"></div>';
            submitBtn.disabled = true;
            
            // Submit form via AJAX
            fetch('/ajax/register', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showNotification(data.message, 'success');
                    
                    // Close modal
                    authModal.classList.add('hidden');
                    document.body.style.overflow = '';
                    
                    // Redirect after a short delay
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    // Show error message
                    displayFormErrors(registerErrorMessage, data.errors || data.message);
                    
                    // Reset button
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                // Show error message
                displayFormErrors(registerErrorMessage, 'Bir hata oluştu. Lütfen tekrar deneyin.');
                
                // Reset button
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            });
        });
    }
    */
}); 