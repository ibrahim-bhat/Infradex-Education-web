<?php
// Mail Server Configuration
define('MAIL_MAILER', 'smtp');
define('MAIL_HOST', 'mail.infradex.in');  // Razorhost SMTP server
define('MAIL_PORT', 465);  // Usually 465 for SSL or 587 for TLS
define('MAIL_USERNAME', 'connect@infradex.in');
define('MAIL_PASSWORD', 'Connect@321');
define('MAIL_ENCRYPTION', 'ssl');  // Change to 'ssl' for port 465
define('MAIL_FROM_ADDRESS', 'connect@infradex.in');
define('MAIL_FROM_NAME', 'Infradex Education');

// Email Templates Directory
define('EMAIL_TEMPLATES_DIR', __DIR__ . '/../email_templates/'); 