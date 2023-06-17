<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $senderEmail = $_POST['sender_email'];
    $recipientEmail = $_POST['recipient_email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Enable SMTP debugging
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        // Set mailer to use SMTP
        $mail->isSMTP();

        // SMTP configuration
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lopajt@gmail.com'; // Your Gmail email address
        $mail->Password = 'lopajt2000'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom($senderEmail);
        $mail->addAddress($recipientEmail);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send the email
        $mail->send();

        echo 'Email sent successfully.';
    } catch (Exception $e) {
        echo 'Error: ' . $mail->ErrorInfo;
    }
} else {
    // Redirect to the form page if accessed directly without submitting the form
    header('Location: index.html');
    exit();
}
