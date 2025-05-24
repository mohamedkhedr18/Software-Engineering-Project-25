document.addEventListener('DOMContentLoaded', function() {
    // Logout functionality
    const logoutLink = document.querySelector('a[href*="logout"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // In a real app, this would be an AJAX call to the server
            // For this demo, we'll just redirect
            window.location.href = 'login.php?logout=1';
        });
    }
    
    // Tab functionality
    const tabNavs = document.querySelectorAll('.tabs-nav li');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    if (tabNavs.length && tabPanes.length) {
        tabNavs.forEach((nav, index) => {
            nav.addEventListener('click', function() {
                // Remove active class from all navs and panes
                tabNavs.forEach(n => n.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('active'));
                
                // Add active class to clicked nav and corresponding pane
                this.classList.add('active');
                tabPanes[index].classList.add('active');
            });
        });
    }
});