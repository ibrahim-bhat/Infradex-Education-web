// Add scrolled class to navbar when the page is scrolled
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Check on page load as well (if page is refreshed while scrolled)
document.addEventListener('DOMContentLoaded', function() {
    if (window.scrollY > 50) {
        document.querySelector('.navbar').classList.add('scrolled');
    }
}); 