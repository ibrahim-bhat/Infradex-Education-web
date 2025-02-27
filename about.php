 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>About Us - InfradexEducation</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="./css/styles.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
 </head>

 <body>
     <div class="scanlines"></div>
     <?php include 'components/navbar.php'; ?>


     <!-- Hero Section -->
     <section class="about-hero-section">
         <div class="container">
             <div class="row align-items-center min-vh-100">
                 <div class="col-lg-6" data-aos="fade-right">
                     <span class="badge bg-primary mb-3">Our Story</span>
                     <h1 class="display-4 fw-bold mb-4">Transforming Education Through Innovation</h1>
                     <p class="lead text-muted">Since 2010, we've been helping students achieve their academic dreams through expert guidance and comprehensive support.</p>
                     <div class="mt-5 d-flex gap-3">
                         <button class="btn btn-primary btn-lg">Our Services</button>
                         <button class="btn btn-outline-light btn-lg">Meet Our Team</button>
                     </div>
                 </div>
                 <div class="col-lg-6" data-aos="fade-left">
                     <div class="about-image-grid">
                         <div class="grid-item item1">
                             <img src="./images/about1.jpg" alt="Students">
                         </div>
                         <div class="grid-item item2">
                             <img src="./images/about2.jpg" alt="Campus">
                         </div>
                         <div class="grid-item item3">
                             <img src="./images/about3.jpg" alt="Library">
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- Mission Vision Section -->
     <section class="mission-vision-section py-5">
         <div class="container">
             <div class="row g-4">
                 <div class="col-md-6" data-aos="fade-up">
                     <div class="mission-card">
                         <div class="card-icon">
                             <i class="fas fa-rocket"></i>
                         </div>
                         <h3>Our Mission</h3>
                         <p>To empower students with knowledge and guidance, helping them make informed decisions about their academic future and achieve their educational goals.</p>
                         <ul class="mission-points">
                             <li><i class="fas fa-check-circle"></i> Quality Education Guidance</li>
                             <li><i class="fas fa-check-circle"></i> Student-Centric Approach</li>
                             <li><i class="fas fa-check-circle"></i> Global Educational Network</li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                     <div class="vision-card">
                         <div class="card-icon">
                             <i class="fas fa-eye"></i>
                         </div>
                         <h3>Our Vision</h3>
                         <p>To be the leading global education consultant, creating pathways for students to access quality education worldwide.</p>
                         <ul class="vision-points">
                             <li><i class="fas fa-star"></i> International Recognition</li>
                             <li><i class="fas fa-star"></i> Innovation in Education</li>
                             <li><i class="fas fa-star"></i> Student Success Stories</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- Timeline Section -->
     <section class="timeline-section py-5">
         <div class="container">
             <h2 class="text-center mb-5" data-aos="fade-up">Our Journey</h2>
             <div class="timeline">
                 <div class="timeline-item" data-aos="fade-right">
                     <div class="timeline-dot"></div>
                     <div class="timeline-content">
                         <h3>2010</h3>
                         <p>Founded with a vision to transform education consulting</p>
                     </div>
                 </div>
                 <div class="timeline-item" data-aos="fade-left">
                     <div class="timeline-dot"></div>
                     <div class="timeline-content">
                         <h3>2015</h3>
                         <p>Expanded to 10+ countries with 500+ successful placements</p>
                     </div>
                 </div>
                 <div class="timeline-item" data-aos="fade-right">
                     <div class="timeline-dot"></div>
                     <div class="timeline-content">
                         <h3>2018</h3>
                         <p>Launched innovative digital counseling platform</p>
                     </div>
                 </div>
                 <div class="timeline-item" data-aos="fade-left">
                     <div class="timeline-dot"></div>
                     <div class="timeline-content">
                         <h3>2023</h3>
                         <p>Achieved milestone of 10,000+ successful student placements</p>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- Team Section -->
     <section class="team-section py-5">
         <div class="container">
             <h2 class="text-center mb-5" data-aos="fade-up">Meet Our Team</h2>
             <div class="row g-4">
                 <div class="col-lg-3 col-md-6" data-aos="fade-up">
                     <div class="team-card">
                         <div class="team-image">
                             <img src="./images/team1.jpg" alt="Team Member">
                             <div class="social-overlay">
                                 <a href="#"><i class="fab fa-linkedin"></i></a>
                                 <a href="#"><i class="fab fa-twitter"></i></a>
                                 <a href="#"><i class="fas fa-envelope"></i></a>
                             </div>
                         </div>
                         <div class="team-info">
                             <h4>John Doe</h4>
                             <p>CEO & Founder</p>
                         </div>
                     </div>
                 </div>
                 <!-- Add more team members similarly -->
             </div>
         </div>
     </section>

     <!-- Values Section -->
     <section class="values-section py-5">
         <div class="container">
             <h2 class="text-center mb-5" data-aos="fade-up">Our Core Values</h2>
             <div class="values-grid">
                 <div class="value-card" data-aos="zoom-in">
                     <div class="value-icon">
                         <i class="fas fa-heart"></i>
                     </div>
                     <h4>Integrity</h4>
                     <p>We maintain the highest standards of honesty and transparency in all our dealings.</p>
                 </div>
                 <!-- Add more value cards -->
             </div>
         </div>
     </section>

     <!-- Footer -->
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
     </script>
 </body>

 </html>