<?php

// Replace this with your real email address
$receiving_email_address = 'dhirajgiri91124@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Validate and sanitize form inputs
  $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
  $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

  // Validate inputs
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "All fields are required!";
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format!";
    exit;
  }

  // Prepare email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";
  
  // Email subject and body
  $email_subject = "New Contact Form Message: $subject";
  $email_body = "You have received a new message from the contact form.\n\n" .
                "Name: $name\n" .
                "Email: $email\n\n" .
                "Subject: $subject\n" .
                "Message:\n$message\n";

  // Send the email
  if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
    echo "OK";  // Response for JavaScript success handling
  } else {
    echo "Error: Message could not be sent.";
  }

} else {
  echo "There was an error with your submission. Please try again.";
}
?>
