<?php
require_once 'config.php';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Simple validation
    $errors = [];
    
    if (empty($fullname)) {
        $errors[] = 'Full name is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        // In a real app, you'd hash the password and store the user
        // For this demo, we'll just log them in
        loginUser($email);
        header('Location: dashboard.php');
        exit;
    }
}

$pageTitle = 'Register';
$additionalCSS = 'auth.css';
$additionalJS = 'auth.js';
require_once 'includes/header.php';
?>

<main class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <h1>Create Account</h1>
            <p class="auth-subtitle">Join our community today</p>
            
            <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <form class="auth-form" method="post">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Create a password" required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter">
                            <span class="strength-bar weak"></span>
                            <span class="strength-bar medium"></span>
                            <span class="strength-bar strong"></span>
                        </div>
                        <span class="strength-text">Password strength: <span>Weak</span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
                    </div>
                </div>
                
                <div class="form-group terms">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" required>
                        <span>I agree to the <a href="terms.html">Terms of Service</a> and <a href="privacy.html">Privacy Policy</a></span>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary auth-btn">Create Account</button>
                
                <div class="auth-divider">
                    <span>or</span>
                </div>
                
                <div class="social-login">
                    <button type="button" class="btn btn-outline social-btn">
                        <img src="https://cdn-teams-slug.flaticon.com/google.jpg" alt=""> Continue with Google
                    </button>
                    <button type="button" class="btn btn-outline social-btn">
                        <img src="https://static.vecteezy.com/system/resources/previews/018/930/476/non_2x/facebook-logo-facebook-icon-transparent-free-png.png" alt=""> Continue with Facebook
                    </button>
                </div>
                
                <div class="auth-footer">
                    Already have an account? <a href="login.php">Sign in</a>
                </div>
            </form>
        </div>
        
        <div class="auth-hero">
            <div class="hero-content">
                <h2>Benefits of Joining</h2>
                <p>Create an account to enjoy these advantages:</p>
                <ul class="benefits-list">
                    <li><i class="fas fa-check-circle"></i> Faster checkout process</li>
                    <li><i class="fas fa-check-circle"></i> Track your order history</li>
                    <li><i class="fas fa-check-circle"></i> Save items to your wishlist</li>
                    <li><i class="fas fa-check-circle"></i> Receive exclusive member deals</li>
                    <li><i class="fas fa-check-circle"></i> Earn rewards points</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>