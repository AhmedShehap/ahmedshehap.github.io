<?php
// Replace this with your own email address
$to = 'the.lonely.knight.h@gmail.com';

function url() {
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
    );
}

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $contact_message = trim($_POST['message']);

    // Basic validation
    if (empty($name) || empty($email) || empty($contact_message)) {
        echo "All fields are required.";
        exit;
    }

    if ($subject == '') { 
        $subject = "Contact Form Submission"; 
    }

    // Initialize message
    $message = '';
    $message .= "Email from: " . $name . "<br />";
    $message .= "Email address: " . $email . "<br />";
    $message .= "Message: <br />";
    $message .= nl2br($contact_message);
    $message .= "<br /> ----- <br /> This email was sent from your site " . url() . " contact form. <br />";

    // Set headers
    $headers = "From: " . $name . " <" . $email . ">" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    $mail = mail($to, $subject, $message, $headers);

    if ($mail) { 
        echo "OK"; 
    } else { 
        echo "Something went wrong. Please try again."; 
    }
}
?>
