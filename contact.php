<?php
// Start session first
session_start();

// Enable error reporting for debugging (Disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include configuration and required files
require 'htaccess/config.php';
require 'includes/functions.php'; // Make sure this is included for CSRF functions
require 'includes/PHPMailer/Exception.php';
require 'includes/PHPMailer/PHPMailer.php';
require 'includes/PHPMailer/SMTP.php';

// Use PHPMailer namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set page title (needed for header)
$pageTitle = 'Contact Me | Elliot Tindall';

// Include the header
include 'includes/aboutheader.php';

// Initialize variables
$name = $email = $message = '';
$nameErr = $emailErr = $messageErr = '';
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debug information
    error_log('Form submitted. POST data: ' . print_r($_POST, true));
    
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        error_log('CSRF token verification failed');
        $errorMsg = 'Invalid form submission.';
    } else {
        error_log('CSRF token verified successfully');
        // Validate Name
        if (empty($_POST['name'])) {
            $nameErr = 'Name is required.';
        } else {
            $name = test_input($_POST['name']);
        }

        // Validate Email
        if (empty($_POST['email'])) {
            $emailErr = 'Email is required.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format.';
        } else {
            $email = test_input($_POST['email']);
        }

        // Validate Message
        if (empty($_POST['message'])) {
            $messageErr = 'Message is required.';
        } else {
            $message = test_input($_POST['message']);
        }

        // Check if all fields are valid
        if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
            /*insert entry data into db ****FUTURE USE ONLY*****/
            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                //$mail->SMTPDebug = 2; // Enable verbose debug output (for debugging)
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST; // Defined in config.php
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USERNAME; // Defined in config.php
                $mail->Password   = SMTP_PASSWORD; // Defined in config.php

                // Define the encryption method based on the config
                if (strtolower(SMTP_ENCRYPTION) === 'ssl') {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                } elseif (strtolower(SMTP_ENCRYPTION) === 'tls') {
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                } else {
                    // Default to TLS if not specified correctly
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                }

                $mail->Port       = SMTP_PORT; // Defined in config.php

                // Recipients
                $mail->setFrom(SMTP_USERNAME, SENDER_NAME); // Defined in config.php
                $mail->addAddress(RECIPIENT_EMAIL, ''); // Recipient name can be left blank or set accordingly

                // Reply-To
                $mail->addReplyTo($email, $name); // User's email and name

                // Content
                $mail->isHTML(false); // Set email format to plain text
                $mail->Subject = 'New Contact Form Submission';
                $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

                $mail->send();
                $successMsg = 'Your message has been sent successfully!';
                // Clear form fields
                $name = $email = $message = '';
            } catch (Exception $e) {
                $errorMsg = 'An error occurred while sending your message. Please try again later.';
                // Log the error message for debugging (ensure error logs are secure)
                error_log('Mailer Error: ' . $mail->ErrorInfo);
            }
        }
    }
}

// Add this just before the form HTML to verify session
error_log('Session status: ' . print_r($_SESSION, true));

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- Contact Form -->
<section class="contact-form" data-aos="fade-up">
    <h2>Contact Me</h2>
    <?php if ($successMsg): ?>
        <p class="success"><?php echo htmlspecialchars($successMsg); ?></p>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
        <p class="error"><?php echo htmlspecialchars($errorMsg); ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name:<span class="required">*</span></label>
            <?php if ($nameErr): ?>
                <span class="error"><?php echo htmlspecialchars($nameErr); ?></span>
            <?php endif; ?>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email:<span class="required">*</span></label>
            <?php if ($emailErr): ?>
                <span class="error"><?php echo htmlspecialchars($emailErr); ?></span>
            <?php endif; ?>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>

        <!-- Message Field -->
        <div class="form-group">
            <label for="message">Message:<span class="required">*</span></label>
            <?php if ($messageErr): ?>
                <span class="error"><?php echo htmlspecialchars($messageErr); ?></span>
            <?php endif; ?>
            <textarea id="message" name="message" required><?php echo htmlspecialchars($message); ?></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn">Send Message</button>
    </form>
</section>

<?php
// Include the footer
include 'includes/footer.php';
?>
