<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfradexEducation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
    /* Add these styles to your existing CSS */
    #forgotPasswordForm {
        max-width: 400px;
        margin: 0 auto;
    }

    #forgotPasswordForm .text-center {
        margin-bottom: 25px;
    }

    #forgotPasswordForm h5 {
        color: #333;
        margin-bottom: 10px;
    }

    #forgotPasswordForm p {
        font-size: 14px;
        color: #666;
    }

    #forgotPasswordForm .btn-link {
        text-decoration: none;
        color: #666;
    }

    #forgotPasswordForm .btn-link:hover {
        color: #333;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }
    </style>
</head>
<body>
    <div class="scanlines"></div>
    <?php include 'components/navbar.php'; ?>

    <!-- Login Modal -->
    <?php if (!isset($_SESSION['user_role'])): ?>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="loginModalLabel">Login to Your Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loginAlert" class="alert" style="display: none;"></div>
                    <form class="login-form" id="loginForm">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <p class="mb-0">Don't have an account? <a href="signup.php" class="register-link">Register</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <!-- <span class="badge bg-dark mb-3">Fullstack Developer Portfolio</span> -->
                    <h1 class="display-4 fw-bold">
                        Bridge <span class="text-primary">to Academic</span><br>
                        Excellence.
                    </h1>
                    <p class="lead text-muted mt-3">
                        Study at the location of your Dreams with Our Professional Guidance.
                    </p>
                    <button class="btn btn-primary btn-lg mt-4">About US</button>
                </div>
                <div class="col-lg-6">
                    <div class="tech-stack-circle"></div>
                </div>
            </div>
            <div class="floating-elements">
                <div class="floating-element element-1"></div>
                <div class="floating-element element-2"></div>
                <div class="floating-element element-3"></div>
                <div class="floating-element element-4"></div>
                <div class="floating-element element-5"></div>
                <div class="floating-element element-6"></div>
            </div>
        </div>
    </section>

    <!-- Countries Section -->
    <section class="countries-section py-5" data-aos="fade-up">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="sub-title">Global Reach</span>
                <h2 class="display-5 fw-bold">Study Destinations</h2>
                <p class="text-muted">Explore Premier Educational Opportunities Worldwide</p>
            </div>
            <div class="floating-elements">
                <div class="floating-element element-2"></div>
                <div class="floating-element element-4"></div>
            </div>
            <div class="countries-grid">
                <!-- First row - 4 countries -->
                <div class="countries-row">
                    <div class="country-card" data-aos="flip-left" data-aos-delay="100">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/us.svg" alt="United States" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">100+ Universities</span>
                                <span class="courses">500+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-university"></i>
                        </div>
                    </div>

                    <div class="country-card" data-aos="flip-left" data-aos-delay="200">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/gb.svg" alt="United Kingdom" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">60+ Universities</span>
                                <span class="courses">400+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-crown"></i>
                        </div>
                    </div>

                    <div class="country-card" data-aos="flip-left" data-aos-delay="300">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/ca.svg" alt="Canada" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">45+ Universities</span>
                                <span class="courses">300+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-leaf"></i>
                        </div>
                    </div>

                    <div class="country-card" data-aos="flip-left" data-aos-delay="400">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/jp.svg" alt="Japan" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">40+ Universities</span>
                                <span class="courses">250+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-torii-gate"></i>
                        </div>
                    </div>
                </div>

                <!-- Second row - 3 countries -->
                <div class="countries-row">
                    <div class="country-card" data-aos="flip-left" data-aos-delay="500">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/in.svg" alt="India" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">50+ Universities</span>
                                <span class="courses">300+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-landmark"></i>
                        </div>
                    </div>

                    <div class="country-card" data-aos="flip-left" data-aos-delay="600">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/ir.svg" alt="Iran" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">30+ Universities</span>
                                <span class="courses">200+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-mosque"></i>
                        </div>
                    </div>

                    <div class="country-card" data-aos="flip-left" data-aos-delay="700">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/np.svg" alt="Nepal" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">15+ Universities</span>
                                <span class="courses">150+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-mountain"></i>
                        </div>
                    </div>
                </div>

                <!-- Third row - 1 country -->
                <div class="countries-row">
                    <div class="country-card" data-aos="flip-left" data-aos-delay="800">
                        <div class="flag-wrapper">
                            <img src="https://flagcdn.com/bt.svg" alt="Bhutan" class="country-flag">
                            <div class="hover-info">
                                <span class="universities">10+ Universities</span>
                                <span class="courses">100+ Courses</span>
                            </div>
                        </div>
                        <div class="country-overlay">
                            <i class="fas fa-mountain"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5" data-aos="fade-up">
        <div class="container">
            <div class="floating-elements">
                <div class="floating-element element-1"></div>
                <div class="floating-element element-5"></div>
            </div>
            <div class="row g-4">
                <!-- Key Statistics -->
                <div class="col-lg-4">
                    <div class="features-grid">
                        <div class="feature-stat">
                            <i class="fas fa-globe"></i>
                            <h3>20+</h3>
                            <p>Countries</p>
                        </div>
                        <div class="feature-stat">
                            <i class="fas fa-university"></i>
                            <h3>120+</h3>
                            <p>Universities</p>
                        </div>
                        <div class="feature-stat">
                            <i class="fas fa-book"></i>
                            <h3>1000+</h3>
                            <p>Courses</p>
                        </div>
                    </div>
                </div>
                
                <!-- Key Features -->
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="feature-card" data-aos="zoom-in" data-aos-delay="200">
                                <div class="feature-icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <h4>Assessment Based Career Counseling</h4>
                                <p>Expert guidance to help you choose the right career path based on your skills and interests.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card" data-aos="zoom-in" data-aos-delay="300">
                                <div class="feature-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h4>University/Program Selection</h4>
                                <p>Personalized assistance in selecting the perfect university and program for your goals.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card" data-aos="zoom-in" data-aos-delay="400">
                                <div class="feature-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4>Admission Procedures</h4>
                                <p>Complete support throughout the admission process from application to acceptance.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card" data-aos="zoom-in" data-aos-delay="500">
                                <div class="feature-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <h4>Scholarships/Loan Assistance</h4>
                                <p>Guidance on available scholarships and assistance with education loan procedures.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card" data-aos="zoom-in" data-aos-delay="600">
                                <div class="feature-icon">
                                    <i class="fas fa-passport"></i>
                                </div>
                                <h4>Visa Documentation Guidance</h4>
                                <p>Expert assistance with visa applications and required documentation.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card" data-aos="zoom-in" data-aos-delay="700">
                                <div class="feature-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <h4>Travel & Accommodation</h4>
                                <p>Support with travel arrangements and finding suitable accommodation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Educational Packages Section -->
    <section class="subscription-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="sub-title">Our Academic Programs</span>
                <h2 class="display-5 fw-bold">Choose Your Class Package</h2>
                <p class="text-muted">Comprehensive Educational Programs for Primary Students</p>
            </div>
            
            <div class="subscription-grid">
                <div class="subscription-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-badge">Class 1-2</div>
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-child"></i>
                        </div>
                        <h3>Foundation Package</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">199</span>
                            <span class="duration">/month</span>
                        </div>
                    </div>
                    <div class="card-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Basic English & Mathematics</li>
                            <li><i class="fas fa-check"></i> Interactive Learning Games</li>
                            <li><i class="fas fa-check"></i> Parent-Teacher Meetings</li>
                            <li><i class="fas fa-check"></i> Monthly Progress Reports</li>
                            <li class="disabled"><i class="fas fa-times"></i> Advanced Subject Support</li>
                            <li class="disabled"><i class="fas fa-times"></i> One-on-One Tutoring</li>
                        </ul>
                    </div>
                    <button class="btn-subscribe">Enroll Now</button>
                </div>

                <div class="subscription-card featured" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-badge">Class 3-4</div>
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3>Intermediate Package</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">299</span>
                            <span class="duration">/month</span>
                        </div>
                    </div>
                    <div class="card-features">
                        <ul>
                            <li><i class="fas fa-check"></i> All Core Subjects</li>
                            <li><i class="fas fa-check"></i> Science Projects & Activities</li>
                            <li><i class="fas fa-check"></i> Weekly Assessments</li>
                            <li><i class="fas fa-check"></i> Digital Learning Resources</li>
                            <li><i class="fas fa-check"></i> Group Study Sessions</li>
                            <li><i class="fas fa-check"></i> Homework Support</li>
                        </ul>
                    </div>
                    <button class="btn-subscribe">Enroll Now</button>
                </div>

                <div class="subscription-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-badge">Class 5</div>
                    <div class="card-header">
                        <div class="icon-wrapper">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3>Advanced Package</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">399</span>
                            <span class="duration">/month</span>
                        </div>
                    </div>
                    <div class="card-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Comprehensive Subject Coverage</li>
                            <li><i class="fas fa-check"></i> Entrance Exam Preparation</li>
                            <li><i class="fas fa-check"></i> One-on-One Mentoring</li>
                            <li><i class="fas fa-check"></i> Advanced Learning Materials</li>
                            <li><i class="fas fa-check"></i> Performance Analytics</li>
                            <li><i class="fas fa-check"></i> Parent Counseling Sessions</li>
                        </ul>
                    </div>
                    <button class="btn-subscribe">Enroll Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold">Our Services</h2>
                <p class="text-muted">Comprehensive Educational Consulting Services</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="service-card">
                        <div class="icon-box">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>University Admissions</h3>
                        <p>Expert guidance for university applications and admissions process worldwide.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-card">
                        <div class="icon-box">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3>Visa Assistance</h3>
                        <p>Complete support for student visa applications and documentation.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-card">
                        <div class="icon-box">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Study Abroad</h3>
                        <p>Comprehensive counseling for international education opportunities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card" data-aos="flip-up" data-aos-delay="300">
                        <h3 class="counter">500+</h3>
                        <p>Students Placed</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" data-aos="flip-up" data-aos-delay="400">
                        <h3 class="counter">50+</h3>
                        <p>Partner Universities</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" data-aos="flip-up" data-aos-delay="500">
                        <h3 class="counter">20+</h3>
                        <p>Countries</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card" data-aos="flip-up" data-aos-delay="600">
                        <h3 class="counter">95%</h3>
                        <p>Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold">Student Testimonials</h2>
                <p class="text-muted">What Our Students Say About Us</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <p class="testimonial-text">
                            "The guidance I received was invaluable. They helped me secure admission to my dream university!"
                        </p>
                        <div class="student-info">
                            <div class="student-details">
                                <h5>Sarah Johnson</h5>
                                <p>University of Toronto</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more testimonial cards as needed -->
            </div>
        </div>
    </section>
    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="footer-top py-5">
            <div class="container">
                <div class="row g-4">
                    <!-- Company Info -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget">
                            <img src="./images/eee.png" alt="Logo" class="footer-logo mb-4" width="150">
                            <p class="mb-4">Empowering students to achieve their academic dreams through expert guidance and comprehensive support in international education.</p>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">Quick Links</h4>
                            <ul class="footer-links">
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">About Us</a></li>
                                <li><a href="#services">Services</a></li>
                                <li><a href="#testimonials">Testimonials</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Our Services -->
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">Our Services</h4>
                            <ul class="footer-links">
                                <li><a href="#">University Admissions</a></li>
                                <li><a href="#">Visa Assistance</a></li>
                                <li><a href="#">Career Counseling</a></li>
                                <li><a href="#">Test Preparation</a></li>
                                <li><a href="#">Immigration Services</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">Contact Info</h4>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p>123 Education Street, Suite 500<br>New York, NY 10001</p>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <p>
                                        <a href="tel:+1234567890">+1 (234) 567-890</a><br>
                                        <a href="tel:+1234567890">+1 (234) 567-891</a>
                                    </p>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <p>
                                        <a href="mailto:info@infradexeducation.com">info@infradexeducation.com</a><br>
                                        <a href="mailto:support@infradexeducation.com">support@infradexeducation.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="footer-middle py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="mb-lg-0 text-white">Subscribe to Our Newsletter</h4>
                    </div>
                    <div class="col-lg-6">
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Enter your email">
                                <button class="btn btn-primary" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-md-0 text-center text-md-start">
                            © 2023 Infradex Education. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <ul class="terms-links">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            
            const email = $('input[name="email"]').val();
            const password = $('input[name="password"]').val();
            const submitBtn = $(this).find('button[type="submit"]');
            
            // Disable button and show loading state
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Loading...');
            
            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#loginAlert')
                            .removeClass('alert-danger')
                            .addClass('alert-success')
                            .html('Login successful! Redirecting...')
                            .show();
                            
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1500);
                    } else {
                        $('#loginAlert')
                            .removeClass('alert-success')
                            .addClass('alert-danger')
                            .html(response.message)
                            .show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Login error:", error);
                    $('#loginAlert')
                        .removeClass('alert-success')
                        .addClass('alert-danger')
                        .html('Login is process. Website in Deployment phase.')
                        .show();
                },
                complete: function() {
                    // Re-enable button and restore text
                    submitBtn.prop('disabled', false).html('Login');
                }
            });
        });

        // Handle forgot password link click
        $(document).on('click', '.forgot-password', function(e) {
            e.preventDefault();
            
            const modalBody = $('#loginModal .modal-body');
            modalBody.html(`
                <div id="forgotAlert" class="alert" style="display: none;"></div>
                <form id="forgotPasswordForm">
                    <div class="text-center mb-4">
                        <h5>Forgot Password</h5>
                        <p class="text-muted">Enter your email address and we'll send you instructions to reset your password.</p>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Send Reset Link</button>
                    <button type="button" class="btn btn-link w-100" id="backToLogin">Back to Login</button>
                </form>
            `);
        });

        // Handle back to login button
        $(document).on('click', '#backToLogin', function() {
            const modalBody = $('#loginModal .modal-body');
            modalBody.html(`
                <div id="loginAlert" class="alert" style="display: none;"></div>
                <form class="login-form" id="loginForm">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            `);
        });

        // Handle forgot password form submission
        $(document).on('submit', '#forgotPasswordForm', function(e) {
            e.preventDefault();
            
            const email = $(this).find('input[name="email"]').val();
            const submitBtn = $(this).find('button[type="submit"]');
            
            // Disable button and show loading state
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Sending...');
            
            $.ajax({
                url: 'forgot-password.php',
                type: 'POST',
                data: { email: email },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#forgotAlert')
                            .removeClass('alert-danger')
                            .addClass('alert-success')
                            .html(response.message)
                            .show();
                        
                        // Hide the form
                        $('#forgotPasswordForm').hide();
                    } else {
                        $('#forgotAlert')
                            .removeClass('alert-success')
                            .addClass('alert-danger')
                            .html(response.message)
                            .show();
                    }
                },
                error: function() {
                    $('#forgotAlert')
                        .removeClass('alert-success')
                        .addClass('alert-danger')
                        .html('An error occurred. Please try again.')
                        .show();
                },
                complete: function() {
                    // Re-enable button and restore text
                    submitBtn.prop('disabled', false).html('Send Reset Link');
                }
            });
        });
    });
    </script>
</body>
</html>
