<?php
require_once 'config/db_connect.php';
require_once 'utils/Mailer.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    try {
        // Initialize mailer and send emails
        $mailer = new Mailer();
        $mailer->sendContactFormEmail($name, $email, $phone, $subject, $message);

        // Store in database
        $query = "INSERT INTO contact_messages (name, email, phone, subject, message, created_at) 
                  VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
        $stmt->execute();

        $success_message = "Thank you! Your message has been sent successfully.";

    } catch (Exception $e) {
        error_log("Contact form error: " . $e->getMessage());
        $error_message = "Sorry, there was an error sending your message. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - InfradexEducation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <div class="scanlines"></div>
    <?php include 'components/navbar.php'; ?>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="contact-info">
                        <h1 class="display-4 fw-bold mb-4">Get In Touch</h1>
                        <p class="lead text-muted mb-5">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>

                        <div class="contact-details">
                            <div class="contact-item mb-4">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <h5>Our Location</h5>
                                    <p>Sallar Complex ,Saraibal
                                        Srinagar, J&K 190001</p>
                                </div>
                            </div>

                            <div class="contact-item mb-4">
                                <i class="fas fa-phone-alt"></i>
                                <div>
                                    <h5>Phone Number</h5>
                                    <p>
                                        <a href="tel:+919796931231">+91 979-6931-231</a><br>
                                        <a href="tel:+919906931231">+91 990-6931-231</a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <h5>Email Address</h5>
                                    <p>
                                        <a href="mailto:connect@infradex.in">connect@infradex.in</a><br>
                                        <a href="mailto:">grievance@infradex.in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="contact-form-wrapper">
                        <?php if ($success_message): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($error_message): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form class="contact-form">
                            <div class="mb-4">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-4">
                                <input type="tel" class="form-control" placeholder="Phone Number" required>
                            </div>
                            <div class="mb-4">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section py-5">
        <div class="container">
            <div class="map-container" data-aos="zoom-in">
                <div class="map-overlay">
                    <div class="overlay-content">
                        <h3>Visit Our Office</h3>
                        <p>123 Education Street, Suite 500<br>New York, NY 10001</p>
                        <button class="btn btn-primary btn-view-map">
                            <i class="fas fa-map-marked-alt"></i> View Full Map
                        </button>
                    </div>
                </div>
                <div class="map-frame">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.25436351647!2d-74.11976404950947!3d40.69767006825552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1647627124741!5m2!1sen!2sin"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Features -->
    <!-- <section class="location-features py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="location-feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-subway"></i>
                        </div>
                        <h4>Public Transport</h4>
                        <p>Easily accessible via subway and bus lines. 5 minutes walk from Central Station.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="location-feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-parking"></i>
                        </div>
                        <h4>Parking Available</h4>
                        <p>Secure parking facility available for visitors with 24/7 surveillance.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="location-feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <h4>Nearby Amenities</h4>
                        <p>Surrounded by cafes, restaurants, and other convenient facilities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <footer class="footer-section">
        <?php include 'components/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>