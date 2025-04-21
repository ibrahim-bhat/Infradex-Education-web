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

        .course-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(128, 0, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(128, 0, 255, 0.15);
            border-color: rgba(128, 0, 255, 0.3);
        }

        .course-card h3 {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .course-card h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #8a2be2, transparent);
        }

        .course-card p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            line-height: 1.6;
        }

        .pricing-section {
            text-align: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            border: 1px solid rgba(128, 0, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .pricing-section h2 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .price-tag {
            display: inline-block;
            background: linear-gradient(45deg, #8a2be2, #5a10f0);
            padding: 1rem 3rem;
            border-radius: 30px;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 1rem 0;
            box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
        }

        .price-tag .currency {
            font-size: 1rem;
            vertical-align: super;
        }

        @media (max-width: 768px) {
            .courses-header h1 {
                font-size: 2rem;
            }

            .courses-header p {
                font-size: 1rem;
                padding: 0 1rem;
            }

            .course-card {
                padding: 1.5rem;
            }

            .course-card h3 {
                font-size: 1.3rem;
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

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="course-card">
                    <h3>SELF CONFIDENCE & SELF ESTEEM</h3>
                    <p>This course helps children recognize their strengths, build a positive self-image, and develop the courage to face challenges with confidence.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="course-card">
                    <h3>EMPATHY AND SHARING</h3>
                    <p>Children learn to understand others' feelings, show kindness, and practice sharing and cooperation in everyday situations.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="course-card">
                    <h3>EMOTIONS MANAGEMENT</h3>
                    <p>This module teaches kids how to identify, express, and manage their emotions in healthy and constructive ways.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="course-card">
                    <h3>RELATIONSHIPS AND COMMUNICATION</h3>
                    <p>This course helps children and teens build strong connections through effective communication and active listening. Learn to handle emotional turbulence, relationship problems, and peer pressure with maturity.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="course-card">
                    <h3>FOCUS AND ORGANISATION</h3>
                    <p>Students are guided on how to manage time, stay organized, and improve attention and concentration for better academic and personal performance.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="course-card">
                    <h3>SOCIALIZATION AND ETHICAL DECISION-MAKING</h3>
                    <p>Encourages teamwork, respect for others, networking and helps kids make fair, responsible, and ethical choices in social situations.</p>
                </div>
            </div>
        </div>

        <div class="pricing-section">
            <h2>Course Price</h2>
            <div class="price-tag">
                <span class="currency">₹</span>49 - 199
            </div>
            <p class="text-light">Access to any individual course</p>
        </div>
    </div>

    <footer class="footer-section mt-5">
        <?php include 'components/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/navbar-scroll.js"></script>
</body>

</html>
