document.addEventListener('DOMContentLoaded', function() {
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
}); 