<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - InfradexEducation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/5d-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .courses-header {
            text-align: center;
            padding: 3rem 0;
            background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
            margin-bottom: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .courses-header h1 {
            color: #fff;
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .courses-header p {
            color: #ecf0f1;
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .coming-soon-wrapper {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
        }

        .coming-soon-content .subtitle {
            font-size: 1.4rem !important;
            line-height: 1.6;
        }

        .feature-list {
            margin-top: 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        .feature-item {
            text-align: center;
            color: #fff;
            flex: 0 1 200px;
        }

        .feature-item i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #4ecdc4;
        }

        .feature-item h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .feature-item p {
            font-size: 0.9rem;
            color: #bdc3c7;
        }

        @media (max-width: 768px) {
            .courses-header h1 {
                font-size: 2rem;
            }

            .courses-header p {
                font-size: 1rem;
                padding: 0 1rem;
            }

            .feature-item {
                flex: 0 1 150px;
            }
        }
    </style>
</head>

<body>
    <div class="scanlines"></div>

    <?php include 'components/navbar.php'; ?>

    <div class="container mt-5 pt-5">
        <div class="courses-header">
            <h1><i class="fas fa-graduation-cap me-3"></i>Our Courses</h1>
            <p>Discover a world of knowledge with our comprehensive course catalog</p>
        </div>

        <?php
        $comingSoonTitle = "Exciting Courses Coming Soon!";
        $comingSoonMessage = "We're crafting an exceptional learning experience for you. Our team is working on bringing you diverse courses across multiple disciplines.";
        include 'components/coming-soon.php';
        ?>

        <div class="feature-list">
            <div class="feature-item">
                <i class="fas fa-laptop-code"></i>
                <h3>Technical Courses</h3>
                <p>Programming, Engineering, and Data Science</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-business-time"></i>
                <h3>Business Studies</h3>
                <p>Management, Finance, and Marketing</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-heartbeat"></i>
                <h3>Medical Sciences</h3>
                <p>MBBS, Nursing, and Healthcare</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-palette"></i>
                <h3>Creative Arts</h3>
                <p>Design, Media, and Fine Arts</p>
            </div>
        </div>
    </div>

    <footer class="footer-section mt-5">
        <?php include 'components/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/navbar-scroll.js"></script>
</body>

</html>
