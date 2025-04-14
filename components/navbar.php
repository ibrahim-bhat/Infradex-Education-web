<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="https://infradexedu.in">
                <?php
                $basePath = '';
                if (strpos($_SERVER['REQUEST_URI'], '/usp/countries-college') !== false) {
                    $basePath = '../../';
                } else if (strpos($_SERVER['REQUEST_URI'], '/usp/info-cards') !== false) {
                    $basePath = '../../';
                } else if (strpos($_SERVER['REQUEST_URI'], '/usp/servicecards') !== false) {
                    $basePath = '../../';
                } else if (strpos($_SERVER['REQUEST_URI'], '/usp') !== false) {
                    $basePath = '../';
                }
                ?>
                <img src="<?php echo $basePath; ?>images/eee.png" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="https://infradexedu.in">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $basePath; ?>about.php">
                            <i class="fas fa-user"></i>
                            <span>About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $basePath; ?>contact.php">
                            <i class="fas fa-envelope"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $basePath; ?>login-new.php">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login/Dashboard</span>
                        </a>
                    </li>
                </ul>
                <!-- <div class="social-icons">
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div> -->
            </div>
        </div>
    </nav>