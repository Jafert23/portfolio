<?php
// contact.php

// Enable error reporting for debugging (Disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the header
include 'includes/aboutheader.php';

// Include configuration
require 'htaccess/config.php'; // Correct relative path

// Include PHPMailer classes
require 'includes/PHPMailer/Exception.php';
require 'includes/PHPMailer/PHPMailer.php';
require 'includes/PHPMailer/SMTP.php';

// Use PHPMailer namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize variables
$name = $email = $message = '';
$nameErr = $emailErr = $messageErr = '';
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
