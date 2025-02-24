$(document).ready(function() {
    // Sidebar Toggle
    $('#sidebar-toggle').click(function() {
        $('.sidebar').toggleClass('active');
        $('.main-content').toggleClass('expanded');
    });

    // Close sidebar on mobile when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('.sidebar, #sidebar-toggle').length) {
            $('.sidebar').removeClass('active');
        }
    });

    // Animated number counting for stats
    $('.stat-value').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());
        
        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 1000,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });

    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Chart initialization (if you want to add charts)
    if($('#studentsChart').length) {
        new Chart($('#studentsChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Students',
                    data: [65, 59, 80, 81, 56, 55],
                    borderColor: '#4e73df',
                    tension: 0.1
                }]
            }
        });
    }
});

// Add smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Add loading animation
$(document).ajaxStart(function() {
    $('#loading').fadeIn();
}).ajaxStop(function() {
    $('#loading').fadeOut();
}); 