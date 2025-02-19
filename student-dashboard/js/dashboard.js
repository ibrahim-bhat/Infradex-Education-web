// Add overlay to body
const overlay = document.createElement('div');
overlay.className = 'sidebar-overlay';
document.body.appendChild(overlay);

// Close sidebar when clicking overlay
overlay.addEventListener('click', () => {
    document.body.classList.remove('sidebar-open');
});

// Close sidebar when pressing Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.body.classList.remove('sidebar-open');
    }
});

// Handle swipe gestures for mobile
let touchStartX = 0;
let touchEndX = 0;

document.addEventListener('touchstart', e => {
    touchStartX = e.changedTouches[0].screenX;
});

document.addEventListener('touchend', e => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const swipeLength = touchEndX - touchStartX;

    if (Math.abs(swipeLength) > swipeThreshold) {
        if (swipeLength > 0) {
            // Swiped right
            document.body.classList.add('sidebar-open');
        } else {
            // Swiped left
            document.body.classList.remove('sidebar-open');
        }
    }
}

// Add resize handler to close sidebar on larger screens
window.addEventListener('resize', () => {
    if (window.innerWidth > 992) {
        document.body.classList.remove('sidebar-open');
    }
}); 