<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // PHPMailer instance
    $mail = new PHPMailer(true);
    dd($name);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';          // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@atechlogic.com';    // Your email address
        $mail->Password   = 'H3l1t3ch@';    // Your email password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setfrom($email, $name); // From email
        $mail->addaddress('info@atechlogic.com', 'Atech Logic'); // To email

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "<p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Message:</strong><br>$message</p>";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message"; // Plain-text version

        $mail->send();
        echo 'Message sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>