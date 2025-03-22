 <!-- Footer Section -->
 <footer class="footer-section">
     <div class="footer-top py-5">
         <div class="container">
             <div class="row g-4">
                 <!-- Company Info -->
                 <div class="col-lg-2 col-md-6">
                     <div class="footer-widget">
                         <?php
                         $basePath = '';
                         if (strpos($_SERVER['REQUEST_URI'], '/usp/countries-college') !== false) {
                             $basePath = '../../';
                         } else if (strpos($_SERVER['REQUEST_URI'], '/usp/info-cards') !== false) {
                             $basePath = '../../';
                         } else if (strpos($_SERVER['REQUEST_URI'], '/usp') !== false) {
                             $basePath = '../';
                         }
                         ?>
                         <img src="<?php echo $basePath; ?>images/eee.png" alt="Logo" class="footer-logo mb-4" width="150">
                         <p class="mb-4">Empowering students to achieve their academic dreams through expert guidance and comprehensive support in international education.</p>
                         <div class="social-links">
                             <a href="https://www.facebook.com/profile.php?id=61560267472000" class="social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                             <a href="https://www.instagram.com/infradexeducation?igsh=MWM2c2t6cHVoYnQ4aA==" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                             <a href="http://www.youtube.com/@Infradexeducation" class="social-link" target="_blank"><i class="fab fa-youtube"></i></a>
                         </div>
                     </div>
                 </div>

                 <!-- Quick Links -->
                 <div class="col-lg-2 col-md-6">
                     <div class="footer-widget">
                         <h4 class="widget-title">Quick Links</h4>
                         <ul class="footer-links">
                             <li><a href="<?php echo $basePath; ?>#home">Home</a></li>
                             <li><a href="<?php echo $basePath; ?>#about">About Us</a></li>
                             <li><a href="<?php echo $basePath; ?>#contact">Contact</a></li>
                         </ul>
                     </div>
                 </div>

                 <!-- Study Destinations -->
                 <div class="col-lg-2 col-md-6">
                     <div class="footer-widget">
                         <h4 class="widget-title">Study Destinations</h4>
                         <ul class="footer-links">
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/usa.php">Study in USA</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/uk.php">Study in UK</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/canada.php">Study in Canada</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/australia.php">Study in Australia</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/china.php">Study in China</a></li>
                         </ul>
                     </div>
                     <div class="footer-widget mt-3">
                         <h4 class="widget-title">More Countries</h4>
                         <ul class="footer-links">
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/egypt.php">Study in Egypt</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/iran.php">Study in Iran</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/kazakhstan.php">Study in Kazakhstan</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/bangladesh.php">Study in Bangladesh</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/countries-college/india.php">Study in India</a></li>
                         </ul>
                     </div>
                 </div>

                 <!-- USP Links -->
                 <div class="col-lg-2 col-md-6">
                     <div class="footer-widget">
                         <h4 class="widget-title">Our USPs</h4>
                         <ul class="footer-links">
                             <li><a href="<?php echo $basePath; ?>usp/5d.php">5D Career Counseling</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/universityandcourse.php">University & Course Selection</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/documentandvisaguidance.php">Document & Visa Guidance</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/financialplanningscholarships.php">Financial Planning & Scholarships</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/strongnetworkandpartnerships.php">Network & Partnerships</a></li>
                         </ul>
                     </div>
                 </div>

                 <!-- Info Cards -->
                 <div class="col-lg-2 col-md-6">
                     <div class="footer-widget">
                         <h4 class="widget-title">Student Resources</h4>
                         <ul class="footer-links">
                             <li><a href="<?php echo $basePath; ?>usp/info-cards/assessmentbasedcareercounseling.php">Career Counseling</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/info-cards/programselection.php">Program Selection</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/info-cards/admissionprocedures.php">Admission Procedures</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/info-cards/scholarships.php">Scholarships</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/info-cards/visadocuments.php">Visa Documents</a></li>
                             <li><a href="<?php echo $basePath; ?>usp/info-cards/travel.php">Travel Guide</a></li>
                         </ul>
                     </div>
                 </div>

                 <!-- Contact Info -->
                 <div class="col-lg-2 col-md-6">
                     <div class="footer-widget">
                         <h4 class="widget-title">Contact Info</h4>
                         <div class="contact">
                             <div class="contact-link">
                                 <i class="fas fa-map-marker-alt"></i>
                                 <p>Sallar Complex ,Saraibal <br>Srinagar, J&K 190001</p>
                             </div>
                             <div class="contact-link">
                                 <i class="fas fa-phone-alt"></i>
                                 <p>
                                     <a href="tel:+919796931231">+91 979-6931-231</a><br>
                                     <a href="tel:+919906931231">+91 990-6931-231</a>
                                 </p>
                             </div>
                             <div class="contact-link">
                                 <i class="fas fa-envelope"></i>
                                 <p>
                                     <a href="mailto:connect@infradex.in">connect@infradex.in</a><br>
                                     <a href="mailto:">grievance@infradex.in</a>
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Newsletter Section -->
     <!-- <div class="footer-middle py-4">
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
     </div> -->

     <!-- Copyright -->
     <div class="footer-bottom py-3">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-md-6">
                     <p class="mb-md-0 text-center text-md-start">
                         © <?php echo date('Y'); ?> Infradex Education. All Rights Reserved. | Developed by <a href="https://ibrahimbhat.com" target="_blank">Ibrahim</a>
                     </p>
                 </div>
                 <div class="col-md-6">
                     <ul class="terms-links">
                         <li><a href="<?php echo $basePath; ?>#">Terms & Conditions</a></li>
                         <li><a href="<?php echo $basePath; ?>#">Privacy Policy</a></li>
                         <li><a href="<?php echo $basePath; ?>#">FAQ</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </footer>