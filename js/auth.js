document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const strengthText = document.querySelector('.strength-text span');
            const strengthBars = document.querySelectorAll('.strength-bar');
            const password = this.value;
            
            // Reset
            strengthBars.forEach(bar => bar.classList.remove('active'));
            
            if (password.length === 0) {
                strengthText.textContent = '';
                return;
            }
            
            // Very simple strength check
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            if (strength <= 1) {
                strengthText.textContent = 'Weak';
                strengthBars[0].classList.add('active');
            } else if (strength <= 3) {
                strengthText.textContent = 'Medium';
                strengthBars[0].classList.add('active');
                strengthBars[1].classList.add('active');
            } else {
                strengthText.textContent = 'Strong';
                strengthBars.forEach(bar => bar.classList.add('active'));
            }
        });
    }
    
    // Form validation
    const forms = document.querySelectorAll('.auth-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let valid = true;
            
            // Check required fields
            this.querySelectorAll('[required]').forEach(input => {
                if (!input.value.trim()) {
                    valid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });
            
            // Check password match
            const password = this.querySelector('#password');
            const confirmPassword = this.querySelector('#confirm-password');
            if (password && confirmPassword && password.value !== confirmPassword.value) {
                valid = false;
                confirmPassword.classList.add('error');
                alert('Passwords do not match');
            }
            
            if (!valid) {
                e.preventDefault();
            }
        });
    });
});