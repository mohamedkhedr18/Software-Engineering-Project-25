<?php
require_once 'config.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password']; // In a real app, you'd verify this
    
    // Simple validation
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required';
    } else {
        // For demo purposes, we'll accept any non-empty password
        // In a real app, you'd verify credentials against a database
        
        // Check if this is our "demo user" email
        if ($email === 'demo@techbazaar.com') {
            // Set demo user data
            $_SESSION['user'] = [
                'name' => 'Demo User',
                'email' => 'demo@techbazaar.com',
                'phone' => '0105558291' 
            ];
            header('Location: dashboard.php');
            exit;
        } else {
            // For any other email, just log them in with the email as name
            $_SESSION['user'] = [
                'name' => ucfirst(explode('@', $email)[0]),
                'email' => $email,
                'phone' => '0105558291'
            ];
            header('Location: dashboard.php');
            exit;
        }
    }
}

// Handle logout if requested
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

$pageTitle = 'Login - TechBazaar';
$additionalCSS = 'auth.css';
$additionalJS = 'auth.js';
require_once 'includes/header.php';
?>

<main class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <h1>Welcome Back</h1>
            <p class="auth-subtitle">Sign in to access your account</p>
            
            <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <p><?php echo htmlspecialchars($error); ?></p>
            </div>
            <?php endif; ?>
            
            <!-- Demo account notice -->
            <div class="demo-notice">
                <p><strong>Demo Account:</strong> demo@techbazaar.com / any password</p>
            </div>
            
            <form class="auth-form" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="forgot-password.php" class="forgot-password">Forgot password?</a>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary auth-btn">Sign In</button>
                
                <div class="auth-divider">
                    <span>or</span>
                </div>
                
                <div class="social-login">
                    <button type="button" class="btn btn-outline social-btn">
                        <img src="<?php echo BASE_URL; ?>/assets/icons/google.svg" alt=""> Continue with Google
                    </button>
                    <button type="button" class="btn btn-outline social-btn">
                        <img src="https://static.vecteezy.com/system/resources/previews/018/930/476/non_2x/facebook-logo-facebook-icon-transparent-free-png.png" alt=""> Continue with Facebook
                    </button>
                </div>
                
                <div class="auth-footer">
                    Don't have an account? <a href="register.php">Sign up</a>
                </div>
            </form>
        </div>
        
        <div class="auth-hero">
            <div class="hero-content">
                <h2>New to TechBazaar?</h2>
                <p>Join our community and enjoy exclusive benefits:</p>
                <ul class="benefits-list">
                    <li><i class="fas fa-check-circle"></i> Fast checkout</li>
                    <li><i class="fas fa-check-circle"></i> Order tracking</li>
                    <li><i class="fas fa-check-circle"></i> Wishlist saving</li>
                    <li><i class="fas fa-check-circle"></i> Exclusive deals</li>
                </ul>
                <a href="register.php" class="btn btn-outline">Create Account</a>
            </div>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>