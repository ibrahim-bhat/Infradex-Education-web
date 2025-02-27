<?php
require_once __DIR__ . '/../config/mail_config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->configure();
    }

    private function configure() {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = MAIL_HOST;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = MAIL_USERNAME;
            $this->mailer->Password = MAIL_PASSWORD;
            $this->mailer->SMTPSecure = MAIL_ENCRYPTION;
            $this->mailer->Port = MAIL_PORT;

            // Default sender
            $this->mailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        } catch (Exception $e) {
            error_log("Mail configuration error: " . $e->getMessage());
            throw new Exception("Error configuring mail system");
        }
    }

    public function sendWelcomeEmail($to, $name) {
        try {
            $template = file_get_contents(EMAIL_TEMPLATES_DIR . 'welcome.html');
            $template = str_replace('{name}', $name, $template);
            
            $this->mailer->addAddress($to, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Welcome to Infradex Education';
            $this->mailer->Body = $template;
            
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Welcome email error: " . $e->getMessage());
            return false;
        }
    }

    public function sendPasswordReset($to, $name, $resetLink) {
        try {
            $template = file_get_contents(EMAIL_TEMPLATES_DIR . 'password_reset.html');
            $template = str_replace(['{name}', '{reset_link}'], [$name, $resetLink], $template);
            
            $this->mailer->addAddress($to, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Password Reset Request';
            $this->mailer->Body = $template;
            
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Password reset email error: " . $e->getMessage());
            return false;
        }
    }

    public function sendCourseEnrollment($to, $name, $courseName, $details) {
        try {
            $template = file_get_contents(EMAIL_TEMPLATES_DIR . 'course_enrollment.html');
            $template = str_replace(
                ['{name}', '{course_name}', '{enrollment_date}', '{course_details}'],
                [$name, $courseName, date('Y-m-d'), $details],
                $template
            );
            
            $this->mailer->addAddress($to, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Course Enrollment Confirmation';
            $this->mailer->Body = $template;
            
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Course enrollment email error: " . $e->getMessage());
            return false;
        }
    }

    public function sendPaymentConfirmation($to, $name, $amount, $transactionId, $details) {
        try {
            $template = file_get_contents(EMAIL_TEMPLATES_DIR . 'payment_confirmation.html');
            $template = str_replace(
                ['{name}', '{amount}', '{transaction_id}', '{payment_date}', '{details}'],
                [$name, $amount, $transactionId, date('Y-m-d H:i:s'), $details],
                $template
            );
            
            $this->mailer->addAddress($to, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Payment Confirmation';
            $this->mailer->Body = $template;
            
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Payment confirmation email error: " . $e->getMessage());
            return false;
        }
    }
} 