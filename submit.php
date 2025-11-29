<?php
// Customized Contact Form Handler for Aapthi Arun Portfolio
// -----------------------------------------------------------
// This script processes form submissions from your portfolio's contact section.
// It validates inputs, returns JSON responses, and is ready for email integration.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and collect input data
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validation
    $errors = [];

    if ($name === '') {
        $errors[] = "Please enter your name.";
    }

    if ($email === '') {
        $errors[] = "Please enter your email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($subject === '') {
        $errors[] = "Please enter a subject for your message.";
    }

    if ($message === '') {
        $errors[] = "Please enter your message.";
    }

    // If there are no errors, prepare success response
    if (empty($errors)) {

        // ----------------------------------------
        // OPTIONAL EMAIL SENDING (Ready to enable)
        // ----------------------------------------
        // Uncomment and update these lines if you want real email notifications:
        //
        // $to = "aapthiraxidi@gmail.com"; // Replace with your email
        // $headers = "From: $email\r\nReply-To: $email";
        // mail($to, $subject, $message, $headers);
        //
        // ----------------------------------------

        $response = [
            'status' => 'success',
            'message' => 'Thank you, your message has been sent successfully!'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Please correct the following issues:',
            'errors' => $errors
        ];
    }

    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// If accessed directly, redirect to portfolio home page
header('Location: index.html');
exit;
?>