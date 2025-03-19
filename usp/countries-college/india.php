<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>India - InfradexEducation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/5d-styles.css" rel="stylesheet">
    <link href="../../css/university-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="scanlines"></div>

    <?php include '../../components/navbar.php'; ?>

    <div class="container mt-5 pt-5">
        <!-- Country Header -->
        <div class="university-header text-center">
            <div class="container">
                <h1 class="display-4 fw-bold"><i class="fas fa-landmark me-3"></i>Universities in India</h1>
                <p class="lead">Discover top educational institutions across India offering quality programs for international students</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section mb-4">
            <h4 class="text-white mb-3"><i class="fas fa-filter me-2"></i>Filter by State</h4>
            <div class="d-flex flex-wrap">
                <button class="btn btn-primary filter-btn active" data-filter="all">All States</button>
                <button class="btn btn-primary filter-btn" data-filter="maharashtra">Maharashtra</button>
                <button class="btn btn-primary filter-btn" data-filter="delhi">Delhi-NCR</button>
                <button class="btn btn-primary filter-btn" data-filter="Bengaluru">Bengaluru</button>
                <button class="btn btn-primary filter-btn" data-filter="Chandigarh">Chandigarh</button>
                <button class="btn btn-primary filter-btn" data-filter="Mangalore">Mangalore</button>
                <button class="btn btn-primary filter-btn" data-filter="rajasthan">Rajasthan</button>
                <button class="btn btn-primary filter-btn" data-filter="kerala">Kerala</button>
                <button class="btn btn-primary filter-btn" data-filter="other">Other States</button>
            </div>
        </div>

        <?php include 'india-states/maharashtra.php'; ?>
        <?php include 'india-states/bangalore.php'; ?>
        <?php include 'india-states/chandigarh.php'; ?>
        <?php include 'india-states/mangalore.php'; ?>
        <?php include 'india-states/rajasthan.php'; ?>
        <?php include 'india-states/delhi.php'; ?>
        <?php include 'india-states/kerala.php'; ?>

        </div>


        <footer class="footer-section mt-5">
            <?php include '../../components/footer.php'; ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../../js/navbar-scroll.js"></script>
        <script>
            // Filter functionality
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const universityCards = document.querySelectorAll('.university-card');

                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons
                        filterButtons.forEach(btn => btn.classList.remove('active'));

                        // Add active class to clicked button
                        this.classList.add('active');

                        const filter = this.getAttribute('data-filter');

                        universityCards.forEach(card => {
                            if (filter === 'all' || card.getAttribute('data-state') === filter) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });
            });
        </script>
</body>

</html>