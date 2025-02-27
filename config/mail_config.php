<?php
// Mail Server Configuration
define('MAIL_MAILER', 'smtp');
define('MAIL_HOST', 'smtp.gmail.com');  // Change this based on your email provider
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'your-email@gmail.com');  // Change to your email
define('MAIL_PASSWORD', 'your-app-specific-password');  // Change to your app password
define('MAIL_ENCRYPTION', 'tls');
define('MAIL_FROM_ADDRESS', 'your-email@gmail.com');
define('MAIL_FROM_NAME', 'Infradex Education');

// Email Templates Directory
define('EMAIL_TEMPLATES_DIR', __DIR__ . '/../email_templates/'); 