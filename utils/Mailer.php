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

    // New method for sending contact form emails
    public function sendContactFormEmail($name, $email, $phone, $subject, $message) {
        try {
            // Send to admin
            $adminEmailBody = "
                <h3>New Contact Form Submission</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Message:</strong></p>
                <p>{$message}</p>
            ";

            $this->mailer->clearAddresses();
            $this->mailer->addAddress(MAIL_USERNAME);
            $this->mailer->Subject = "New Contact Form Submission: {$subject}";
            $this->mailer->Body = $adminEmailBody;
            $this->mailer->isHTML(true);
            $this->mailer->send();

            // Send auto-reply to user
            $userEmailBody = "
                <h3>Thank you for contacting Infradex Education!</h3>
                <p>Dear {$name},</p>
                <p>We have received your message and will get back to you shortly.</p>
                <p>Here's a copy of your message:</p>
                <hr>
                <p><strong>Subject:</strong> {$subject}</p>
                <p>{$message}</p>
                <hr>
                <p>Best regards,<br>Infradex Education Team</p>
            ";

            $this->mailer->clearAddresses();
            $this->mailer->addAddress($email, $name);
            $this->mailer->Subject = "We've received your message - Infradex Education";
            $this->mailer->Body = $userEmailBody;
            return $this->mailer->send();

        } catch (Exception $e) {
            error_log("Contact form email error: " . $e->getMessage());
            throw new Exception("Failed to send email");
        }
    }
} 